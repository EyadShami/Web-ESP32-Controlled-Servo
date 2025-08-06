# Robot Arm Control Panel (ESP32 + PHP + MySQL)

This project allows you to control a 6-servo robot arm using a web interface built with HTML/CSS/JavaScript, connected to a MySQL database via PHP, and an ESP32 board that reads servo positions from the database and moves the motors accordingly.

---

## Features

- Control 6 servos (0–180°) using sliders
- Save & load custom poses (servo positions)
- Run poses on your actual robot arm (via ESP32)
- View & manage saved poses in a table
- ESP32 receives pose, moves servos, and updates the system

---

## Web Interface Setup

### 1. Install Requirements
- PHP server (e.g., XAMPP)
- MySQL database (included in XAMPP)
- A browser 

### 2. Setup the Database

The project uses a MySQL database named `robot_arm` with two tables:

#### `pose` Table – Stores Saved Servo Poses

| Column  | Type               | Description                 |
|---------|--------------------|-----------------------------|
| id      | INT (AUTO_INCREMENT) | Unique ID for each pose    |
| servo1  | TINYINT UNSIGNED   | Angle of motor 1 (0–180)    |
| servo2  | TINYINT UNSIGNED   | Angle of motor 2 (0–180)    |
| servo3  | TINYINT UNSIGNED   | Angle of motor 3 (0–180)    |
| servo4  | TINYINT UNSIGNED   | Angle of motor 4 (0–180)    |
| servo5  | TINYINT UNSIGNED   | Angle of motor 5 (0–180)    |
| servo6  | TINYINT UNSIGNED   | Angle of motor 6 (0–180)    |

#### `run` Table – Holds the Pose to Execute

| Column  | Type               | Description                              |
|---------|--------------------|------------------------------------------|
| id      | TINYINT (Primary Key) | Always set to 1 (only one row exists) |
| servo1  | TINYINT UNSIGNED   | Target angle for motor 1                 |
| servo2  | TINYINT UNSIGNED   | Target angle for motor 2                 |
| servo3  | TINYINT UNSIGNED   | Target angle for motor 3                 |
| servo4  | TINYINT UNSIGNED   | Target angle for motor 4                 |
| servo5  | TINYINT UNSIGNED   | Target angle for motor 5                 |
| servo6  | TINYINT UNSIGNED   | Target angle for motor 6                 |
| status  | TINYINT            | `1` = new pose available, `0` = consumed |

---

### 3. Place Project Files

Copy all project files into your PHP server directory (e.g., `htdocs/robot_arm` for XAMPP):

```
robot_arm/
├── index.html              # Web page UI
├── config.php              # Database connection
└── api/                    # API endpoints
    ├── get_poses.php
    ├── get_pose.php
    ├── save_pose.php
    ├── delete_pose.php
    ├── run_pose.php
    ├── get_run_pose.php
    └── update_status.php
```

---

## Access the Web Interface

Open your browser and go to:

```
http://localhost/robot_arm/index.html
```

From here you can:
- Use sliders to adjust servo angles
- Save, load, run, and remove poses
- Watch the ESP32 read and execute the poses

---

## ESP32 Setup

### 1. Hardware Requirements

- 1x ESP32 board
- 6x servo motors
- Jumper wires + breadboard
- External 5V power supply for servos

### 2. Connect Servos

| Servo | GPIO |
|-------|------|
| 1     | 13   |
| 2     | 12   |
| 3     | 14   |
| 4     | 27   |
| 5     | 26   |
| 6     | 25   |

**Important**: Power servos using an external 5V source (not from ESP32)!

---

### 3. Install Arduino Libraries

In the Arduino IDE:
- Go to **Sketch ▸ Include Library ▸ Manage Libraries**
- Search for and install: **ESP32Servo**

---

### 4. Upload the Code

Upload the provided ESP32 sketch after setting:

```cpp
const char* ssid = "YOUR_WIFI_SSID";
const char* password = "YOUR_WIFI_PASSWORD";
const char* server = "http://<your_PC_IP>/robot_arm/api";
```

Use your actual local IP (e.g., `http://192.168.1.100`), not `localhost`.

---

### 5. Monitor Serial Output

Open the **Serial Monitor** at **115200 baud**.

Expected output:

```
Booting...
WiFi connected!
IP address: 192.168.1.108
Received: 1,s120,s90,s90,s90,s90,s90
Moving servos:
 Servo 1 → 120°
 Servo 2 → 90°
 ...
Status reset.
```

---

## System Flow

1. **User clicks "Run"** → web saves servo values to `run` table and sets `status = 1`  
2. **ESP32 polls `get_run_pose.php`** → gets values if `status == 1`  
3. **ESP32 moves servos** → then calls `update_status.php` to set `status = 0`

---
## Web Page 
![alt image](https://github.com/EyadShami/Web-ESP32-Controlled-Servo/blob/423d9d8d2d484762b1a38e77dab4b13d780cdc88/Web_ESP32_Controlled_Servo.png)

## Example
![alt image](https://github.com/EyadShami/Web-ESP32-Controlled-Servo/blob/423d9d8d2d484762b1a38e77dab4b13d780cdc88/Example.gif)

