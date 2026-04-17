from ultralytics import YOLO
import cv2

model = YOLO("best.pt")

# Try camera index 0 or 1
cap = cv2.VideoCapture(0)

if not cap.isOpened():
    print("Camera not detected. Trying another index...")
    cap = cv2.VideoCapture(1)

while True:

    ret, frame = cap.read()

    if not ret:
        print("Failed to grab frame")
        break

    results = model(frame)

    for r in results:
        frame = r.plot()

    cv2.imshow("MineSafe AI Detection", frame)

    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

cap.release()
cv2.destroyAllWindows()