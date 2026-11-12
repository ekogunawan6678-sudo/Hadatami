#include <WiFi.h>
#include <HTTPClient.h>

// Konfigurasi Wi-Fi
const char* WIFI_SSID = "HUAWEI-2.4G-M3jA";
const char* WIFI_PASSWORD = "ZRJ9sxSK";

// Ganti dengan IPv4 komputer yang menjalankan Laravel
const char* SERVER_URL = "http://192.168.100.5:8000/api/sensor-data";

// Kode perangkat yang sudah didaftarkan di tabel devices
const char* DEVICE_CODE = "PG-ESP32-001";

// Interval pengiriman data (10 detik)
const unsigned long SEND_INTERVAL = 10000;
unsigned long lastSendTime = 0;

void connectWiFi() {
    Serial.print("Menghubungkan ke Wi-Fi");

    WiFi.mode(WIFI_STA);
    WiFi.begin(WIFI_SSID, WIFI_PASSWORD);

    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
    }

    Serial.println();
    Serial.println("Wi-Fi terhubung!");
    Serial.print("IP ESP32: ");
    Serial.println(WiFi.localIP());
}

void sendSensorData() {
    if (WiFi.status() != WL_CONNECTED) {
        Serial.println("Wi-Fi terputus. Menghubungkan ulang...");
        connectWiFi();
    }

    // DATA SIMULASI untuk pengujian awal.
    // Ganti bagian ini dengan pembacaan sensor fisik nantinya.
    int beetleCount = 12;
    float temperature = 30.5;
    float humidity = 78.2;
    float rainfall = 2.5;

    // Membuat data JSON
    String jsonData = "{";
    jsonData += "\"device_code\":\"" + String(DEVICE_CODE) + "\",";
    jsonData += "\"beetle_count\":" + String(beetleCount) + ",";
    jsonData += "\"temperature\":" + String(temperature, 2) + ",";
    jsonData += "\"humidity\":" + String(humidity, 2) + ",";
    jsonData += "\"rainfall\":" + String(rainfall, 2);
    jsonData += "}";

    WiFiClient client;
    HTTPClient http;

    http.setTimeout(5000);

    if (http.begin(client, SERVER_URL)) {
        http.addHeader("Content-Type", "application/json");

        Serial.println("Mengirim data sensor...");
        Serial.println(jsonData);

        int httpCode = http.POST(jsonData);

        if (httpCode > 0) {
            Serial.print("HTTP Status: ");
            Serial.println(httpCode);

            String response = http.getString();
            Serial.print("Respons server: ");
            Serial.println(response);

            if (httpCode == 201) {
                Serial.println("Data berhasil disimpan ke Laravel.");
            } else {
                Serial.println("Server menerima permintaan, periksa respons.");
            }
        } else {
            Serial.print("Pengiriman gagal: ");
            Serial.println(http.errorToString(httpCode));
        }

        http.end();
    } else {
        Serial.println("Gagal memulai koneksi HTTP.");
    }
}

void setup() {
    Serial.begin(115200);
    delay(1000);

    connectWiFi();
    sendSensorData();
    lastSendTime = millis();
}

void loop() {
    if (millis() - lastSendTime >= SEND_INTERVAL) {
        lastSendTime = millis();
        sendSensorData();
    }
}