import serial
import pynmea2
from sms import sendSms
from Alert import haversine
from mysql import connector as con
from datetime import datetime

def read_gps_data(serial_port="/dev/ttyAMA0", baud_rate=9600):
    connection = con.connect(
            host="13.235.42.204",
            user="raspberry",
            password="SourceKode@1234",
            database='SourceKode')
    cursor = connection.cursor()
    try:
        ser = serial.Serial(serial_port, baud_rate, timeout=5.0)

        while True:
            line = ser.readline().strip()

            line = line.decode("utf-8", errors="ignore")

            if line.startswith("$GPGGA"):
                msg = pynmea2.parse(line)
                
                latitude = msg.latitude
                longitude = msg.longitude
                
                if latitude != 0 and longitude!=0:

                    dist = haversine(latitude, longitude)

                    if (dist > 50):
                        sendSms()
                    cursor.execute("INSERT INTO pin VALUES(now(), POINT(%s, %s))", (latitude, longitude))
                    connection.commit()
                    break
    
    except KeyboardInterrupt:
        print("Program terminated by user.")
    except Exception as e:
        print(f"An error occured: {str(e)}")
    finally:
        if ser.is_open:
            ser.close()
        cursor.close()
        connection.close()


if __name__ == "__main__":
    read_gps_data()
