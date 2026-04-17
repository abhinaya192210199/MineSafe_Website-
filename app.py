from flask import Flask, request, jsonify, send_from_directory
from ultralytics import YOLO
import os
import mysql.connector

app = Flask(__name__)

# =========================
# 🔥 LOAD MODEL
# =========================
model = YOLO("C:/xampp/htdocs/mineguard/ai/weights/best.pt")

# =========================
# 🔥 DATABASE
# =========================
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="mineguard"
)
cursor = db.cursor()

# =========================
# ROOT
# =========================
@app.route("/")
def home():
    return "Flask Running ✅"

# =========================
# LOGIN (optional for app)
# =========================
@app.route("/login", methods=["POST"])
def login():
    data = request.get_json()

    emp = data.get("employee_id")
    pwd = data.get("password")

    if emp == "worker" and pwd == "123":
        return jsonify({"status": "success", "role": "worker"})
    elif emp == "admin" and pwd == "123":
        return jsonify({"status": "success", "role": "supervisor"})
    else:
        return jsonify({"status": "error"})

# =========================
# 🔥 DETECT API
# =========================
@app.route("/detect", methods=["POST"])
def detect():
    try:
        file = request.files["image"]
        employee_id = request.form.get("employee_id", "worker")

        # SAVE IMAGE
        upload_folder = "uploads"
        os.makedirs(upload_folder, exist_ok=True)

        filename = file.filename
        path = os.path.join(upload_folder, filename)
        file.save(path)

        print("IMAGE SAVED:", path)

        # RUN YOLO
        results = model.predict(source=path, save=True, conf=0.01, imgsz=1280)

        detections = []
        safety_status = "SAFE"

        for r in results:
            if r.boxes is not None and len(r.boxes) > 0:
                for box in r.boxes:
                    cls_id = int(box.cls[0])
                    label = model.names[cls_id]
                    detections.append(label)

                    # 🚨 UNSAFE CONDITION
                    if "no_" in label:
                        safety_status = "UNSAFE"
            else:
                detections.append("No objects")

        detections_text = ", ".join(detections)

        print("DETECTIONS:", detections_text)
        print("SAFETY:", safety_status)

        # =========================
        # SAVE AI RESULT
        # =========================
        cursor.execute("""
            INSERT INTO ai_detections (employee_id, detections, safety, image_path)
            VALUES (%s, %s, %s, %s)
        """, (employee_id, detections_text, safety_status, path))

        db.commit()
        print("Saved to ai_detections ✅")

        # =========================
        # 🚨 AUTO ALERT (MAIN FEATURE)
        # =========================
        if safety_status == "UNSAFE":
            cursor.execute("""
                INSERT INTO alerts (worker_id, message)
                VALUES (%s, %s)
            """, (employee_id, "⚠ Unsafe condition detected"))

            db.commit()
            print("ALERT GENERATED 🚨")

        # =========================
        # IMAGE URL (FIXED)
        # =========================
        folder = os.path.basename(results[0].save_dir)
        filename = os.path.basename(path)

        image_url = f"http://10.237.143.26:5000/runs/detect/{folder}/{filename}"

        return jsonify({
            "status": "success",
            "detections": detections,
            "safety": safety_status,
            "image": image_url
        })

    except Exception as e:
        print("ERROR:", str(e))
        return jsonify({"status": "error"})

# =========================
# 🔥 SERVE DETECTED IMAGE
# =========================
@app.route('/runs/detect/<folder>/<filename>')
def serve_detected(folder, filename):
    return send_from_directory(os.path.join('runs/detect', folder), filename)

# =========================
# RUN SERVER
# =========================
if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)