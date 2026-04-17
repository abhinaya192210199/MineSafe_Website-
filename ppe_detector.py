from ultralytics import YOLO
import os

# Model path
model_path = "C:/AI_DATASET/PPE/runs/detect/train/weights/best.pt"

model = None

# Load model only if it exists
if os.path.exists(model_path):
    model = YOLO(model_path)

def detect_ppe(image_path):

    helmet = "Unknown"
    vest = "Unknown"

    # If model not ready yet
    if model is None:
        return "Model Not Ready", "Model Not Ready"

    results = model(image_path)

    helmet = "Missing"
    vest = "Missing"

    for r in results:
        for box in r.boxes:
            cls = int(box.cls[0])
            label = model.names[cls]

            if label == "helmet":
                helmet = "Detected"

            if label == "suit" or label == "vest":
                vest = "Detected"

    return helmet, vest