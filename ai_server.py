from flask import Flask, request, jsonify
from ppe_detector import detect_ppe

app = Flask(__name__)

@app.route("/analyze", methods=["POST"])
def analyze():

    file = request.files["image"]
    path = "temp.jpg"
    file.save(path)

    helmet, vest = detect_ppe(path)

    fatigue = "Low"
    risk = 20

    if helmet == "Missing":
        risk += 40

    if vest == "Missing":
        risk += 30

    return jsonify({
        "helmet": helmet,
        "vest": vest,
        "fatigue": fatigue,
        "risk_score": risk
    })

if __name__ == "__main__":
    app.run(port=5000)