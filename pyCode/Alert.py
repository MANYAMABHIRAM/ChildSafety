from math import radians, sin, cos, sqrt, atan2
from mysql import connector as con
def haversine(lat, lon):
   connection = con.connect(
           host="13.235.42.204",
           user="raspberry",
           password="SourceKode@1234",
           database='SourceKode'
           )
   cursor = connection.cursor()
   cursor.execute("SELECT LAST_INSERT_ID() FROM absoluteLoc")
   last_inserted_id = cursor.fetchone()[0]
   cursor.execute(f"SELECT ST_X(loc), ST_Y(loc), radius FROM absoluteLoc WHERE id={last_inserted_id}")
   lata, longa = cursor.fetchone()
   # Convert latitude and longitude from degrees to radians
   lat1, lon1, lat2, lon2 = map(radians, [16.25487957384041, 80.32584173710009, lat, lon])

   # Haversine formula
   dlat = lat2 - lat1
   dlon = lon2 - lon1
   a = sin(dlat / 2) ** 2 + cos(lat1) * cos(lat2) * sin(dlon / 2) ** 2
   c = 2 * atan2(sqrt(a), sqrt(1 - a))
   # Radius of Earth in kilometers (change to 3959.0 for miles)
   radius = 6371.0
   cursor.close()
   connection.close()
   # Calculate the distance
   distance = radius * c

   return 1000 * distance

# Example usage
#lat1, lon1 = 37.7749, -122.4194  # Replace with your first coordinates
#lat2, lon2 = 40.7128, -74.0060   # Replace with your second coordinates

#distance_km =1000* haversine(lat1, lon1, lat2, lon2)
#print(f"Distance: {distance_km:.2f} meters")
