-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 08, 2024 at 06:09 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_extension`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `device_id` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `device_id`, `category_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '0000000001', 2, '0', NULL, NULL),
(2, '0000000002', 2, '0', NULL, NULL),
(3, '0000000003', 2, '0', NULL, NULL),
(4, '0000000004', 2, '0', NULL, NULL),
(5, '0000000005', 2, '0', NULL, NULL),
(6, '0000000006', 2, '0', NULL, NULL),
(7, '0000000007', 2, '0', NULL, NULL),
(8, '0000000008', 2, '0', NULL, NULL),
(9, '0000000009', 2, '0', NULL, NULL),
(10, '0000000010', 2, '0', NULL, NULL),
(11, '0000000011', 2, '0', NULL, NULL),
(12, '0000000012', 2, '1', NULL, '2024-05-23 21:26:34');

-- --------------------------------------------------------

--
-- Table structure for table `device_categories`
--

CREATE TABLE `device_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `stock` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `device_categories`
--

INSERT INTO `device_categories` (`id`, `name`, `price`, `image`, `description`, `stock`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'Ekstensi Lampu', '50000', 'ekstensi-lampu-device.png', '<p>ini adalah enstensi lampu piter yang pinternya kebangetan deh </p>', '15', 'ekstensi-lampu', '2024-05-23 14:36:36', '2024-07-28 15:30:10');

-- --------------------------------------------------------

--
-- Table structure for table `device_sensors`
--

CREATE TABLE `device_sensors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `device_id` bigint(20) UNSIGNED NOT NULL,
  `sensor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `device_sensors`
--

INSERT INTO `device_sensors` (`id`, `device_id`, `sensor_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-05-23 21:15:05', '2024-05-23 21:15:05'),
(2, 2, 1, '2024-05-23 21:15:05', '2024-05-23 21:15:05'),
(3, 3, 1, '2024-05-23 21:15:05', '2024-05-23 21:15:05'),
(4, 4, 1, '2024-05-23 21:15:05', '2024-05-23 21:15:05'),
(5, 5, 1, '2024-05-23 21:15:05', '2024-05-23 21:15:05'),
(6, 6, 1, '2024-05-23 21:15:05', '2024-05-23 21:15:05'),
(7, 7, 1, '2024-05-23 21:15:05', '2024-05-23 21:15:05'),
(8, 8, 1, '2024-05-23 21:15:05', '2024-05-23 21:15:05'),
(9, 9, 1, '2024-05-23 21:15:05', '2024-05-23 21:15:05'),
(10, 10, 1, '2024-05-23 21:15:05', '2024-05-23 21:15:05'),
(11, 11, 1, '2024-05-23 21:15:05', '2024-05-23 21:15:05'),
(12, 12, 1, '2024-05-23 21:15:05', '2024-05-23 21:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_05_23_104003_create_devices_table', 1),
(8, '2023_06_04_144805_create_roles_table', 2),
(10, '2024_05_23_105024_create_device_categories_table', 3),
(12, '2024_05_24_014928_create_device_sensors_table', 5),
(13, '2024_05_24_015433_create_sensor_parameters_table', 5),
(15, '2024_05_24_015439_create_sensors_table', 6),
(17, '2024_05_23_103916_create_user_devices_table', 7),
(18, '2024_05_27_062301_create_user_device_schedules_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2024-05-23 05:35:17', '2024-05-23 05:35:17'),
(2, 'Customer', '2024-05-23 05:35:17', '2024-05-23 05:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `sensors`
--

CREATE TABLE `sensors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `code` text NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sensors`
--

INSERT INTO `sensors` (`id`, `name`, `image`, `code`, `description`, `created_at`, `updated_at`) VALUES
(1, 'DHT22', 'dht22-sensor.jpg', '<p>#include &lt;ESP8266WiFi.h&gt;</p><p>#include &lt;PubSubClient.h&gt;</p><p>#include &lt;DHT.h&gt;</p><p><br></p><p>// Konfigurasi WiFi</p><p>const char* ssid = \"V2043\";</p><p>const char* password = \"iii12345678\";</p><p><br></p><p>// Konfigurasi HiveMQ</p><p>const char* mqtt_server = \"28e872855c24444a9de2ffc173b98626.s1.eu.hivemq.cloud\";</p><p>const int mqtt_port = 8883; // Port untuk SSL/TLS</p><p>const char* mqtt_user = \"fahmi_dev\";</p><p>const char* mqtt_pass = \"unindra123\";</p><p><br></p><p>// Konfigurasi pin relay dan sensor DHT22</p><p>#define RELAY_PIN 2&nbsp; &nbsp; // Pin RELAY (GPIO2)</p><p>#define DHTPIN 0&nbsp; &nbsp; &nbsp; &nbsp;// Pin yang terhubung ke sensor DHT22</p><p>#define DHTTYPE DHT22&nbsp; // Tipe sensor DHT</p><p><br></p><p>WiFiClientSecure espClient;</p><p>PubSubClient client(espClient);</p><p>DHT dht(DHTPIN, DHTTYPE);</p><p><br></p><p>unsigned long lastReconnectAttempt = 0;</p><p>unsigned long lastDHTReadTime = 0;</p><p>const unsigned long DHTReadInterval = 2000; // Interval pembacaan DHT22 dalam milidetik</p><p><br></p><p>void setup_wifi() {</p><p>&nbsp; Serial.begin(115200);</p><p>&nbsp; delay(10);</p><p>&nbsp; Serial.println();</p><p>&nbsp; Serial.print(\"Menghubungkan ke \");</p><p>&nbsp; Serial.println(ssid);</p><p>&nbsp; WiFi.begin(ssid, password);</p><p>&nbsp; while (WiFi.status() != WL_CONNECTED) {</p><p>&nbsp; &nbsp; delay(500);</p><p>&nbsp; &nbsp; Serial.print(\".\");</p><p>&nbsp; }</p><p>&nbsp; Serial.println(\"\");</p><p>&nbsp; Serial.println(\"WiFi tersambung\");</p><p>&nbsp; Serial.print(\"IP address: \");</p><p>&nbsp; Serial.println(WiFi.localIP());</p><p>}</p><p><br></p><p>void callback(char* topic, byte* payload, unsigned int length) {</p><p>&nbsp; Serial.print(\"Pesan diterima [\");</p><p>&nbsp; Serial.print(topic);</p><p>&nbsp; Serial.print(\"] \");</p><p>&nbsp;&nbsp;</p><p>&nbsp; char message[length + 1];</p><p>&nbsp; for (unsigned int i = 0; i &lt; length; i++) {</p><p>&nbsp; &nbsp; message[i] = (char)payload[i];</p><p>&nbsp; }</p><p>&nbsp; message[length] = \'\\0\';&nbsp; // Null-terminating the message</p><p>&nbsp; Serial.println(message);</p><p>&nbsp;&nbsp;</p><p>&nbsp; // Cek apakah pesan diterima dari topik relay</p><p>&nbsp; if (strcmp(topic, \"relay/control\") == 0) {</p><p>&nbsp; &nbsp; if (strcmp(message, \"ON\") == 0) {</p><p>&nbsp; &nbsp; &nbsp; digitalWrite(RELAY_PIN, HIGH);</p><p>&nbsp; &nbsp; &nbsp; Serial.println(\"Relay ON\");</p><p>&nbsp; &nbsp; } else if (strcmp(message, \"OFF\") == 0) {</p><p>&nbsp; &nbsp; &nbsp; digitalWrite(RELAY_PIN, LOW);</p><p>&nbsp; &nbsp; &nbsp; Serial.println(\"Relay OFF\");</p><p>&nbsp; &nbsp; }</p><p>&nbsp; }</p><p>}</p><p><br></p><p>boolean reconnect() {</p><p>&nbsp; if (client.connect(\"D1MiniClient\", mqtt_user, mqtt_pass)) {</p><p>&nbsp; &nbsp; Serial.println(\"terhubung\");</p><p>&nbsp; &nbsp; // Subscribe ke topik relay</p><p>&nbsp; &nbsp; client.subscribe(\"relay/control\");</p><p>&nbsp; }</p><p>&nbsp; return client.connected();</p><p>}</p><p><br></p><p>void setup() {</p><p>&nbsp; Serial.begin(115200);</p><p>&nbsp; setup_wifi();</p><p>&nbsp; espClient.setInsecure();</p><p>&nbsp; client.setServer(mqtt_server, mqtt_port);</p><p>&nbsp; client.setCallback(callback);</p><p>&nbsp; pinMode(RELAY_PIN, OUTPUT);</p><p>&nbsp; digitalWrite(RELAY_PIN, LOW); // Mematikan relay pada awalnya</p><p>&nbsp; dht.begin();</p><p>&nbsp; lastReconnectAttempt = 0;</p><p>}</p><p><br></p><p>void loop() {</p><p>&nbsp; if (!client.connected()) {</p><p>&nbsp; &nbsp; unsigned long now = millis();</p><p>&nbsp; &nbsp; // Try reconnecting every 5 seconds</p><p>&nbsp; &nbsp; if (now - lastReconnectAttempt &gt; 5000) {</p><p>&nbsp; &nbsp; &nbsp; lastReconnectAttempt = now;</p><p>&nbsp; &nbsp; &nbsp; if (reconnect()) {</p><p>&nbsp; &nbsp; &nbsp; &nbsp; lastReconnectAttempt = 0;</p><p>&nbsp; &nbsp; &nbsp; }</p><p>&nbsp; &nbsp; }</p><p>&nbsp; } else {</p><p>&nbsp; &nbsp; client.loop();</p><p>&nbsp; }</p><p><br></p><p>&nbsp; // Baca data dari sensor DHT22</p><p>&nbsp; unsigned long now = millis();</p><p>&nbsp; if (now - lastDHTReadTime &gt; DHTReadInterval) {</p><p>&nbsp; &nbsp; lastDHTReadTime = now;</p><p>&nbsp; &nbsp; float h = dht.readHumidity();</p><p>&nbsp; &nbsp; float t = dht.readTemperature();</p><p>&nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; // Cek apakah pembacaan berhasil</p><p>&nbsp; &nbsp; if (isnan(h) || isnan(t)) {</p><p>&nbsp; &nbsp; &nbsp; Serial.println(\"Gagal membaca dari sensor DHT22!\");</p><p>&nbsp; &nbsp; } else {</p><p>&nbsp; &nbsp; &nbsp; // Kirim data ke server MQTT</p><p>&nbsp; &nbsp; &nbsp; char tempString[8];</p><p>&nbsp; &nbsp; &nbsp; dtostrf(t, 1, 2, tempString);</p><p>&nbsp; &nbsp; &nbsp; char humString[8];</p><p>&nbsp; &nbsp; &nbsp; dtostrf(h, 1, 2, humString);</p><p>&nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; client.publish(\"sensor/temperature\", tempString);</p><p>&nbsp; &nbsp; &nbsp; client.publish(\"sensor/humidity\", humString);</p><p>&nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; Serial.print(\"Temperature: \");</p><p>&nbsp; &nbsp; &nbsp; Serial.print(tempString);</p><p>&nbsp; &nbsp; &nbsp; Serial.print(\" °C, Humidity: \");</p><p>&nbsp; &nbsp; &nbsp; Serial.print(humString);</p><p>&nbsp; &nbsp; &nbsp; Serial.println(\" %\");</p><p>&nbsp; &nbsp; }</p><p>&nbsp; }</p><p>}</p><div><br></div>', '<p>DHT 22 adalah sensor yang bagus yagesya</p>', NULL, '2024-05-23 20:53:47');

-- --------------------------------------------------------

--
-- Table structure for table `sensor_parameters`
--

CREATE TABLE `sensor_parameters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sensor_id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sensor_parameters`
--

INSERT INTO `sensor_parameters` (`id`, `sensor_id`, `key`, `type`, `created_at`, `updated_at`) VALUES
(5, 1, 't', 'float', '2024-05-23 20:53:47', '2024-05-23 20:53:47'),
(6, 1, 'h', 'float', '2024-05-23 20:53:47', '2024-05-23 20:53:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `whatsapp` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `whatsapp`, `email_verified_at`, `password`, `role_id`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'r4mz.id@gmail.com', '81224752917', '2024-05-23 12:14:27', '$2y$10$SWkCQk5AunnZRzUUuZiTauAsWcFBrg6SwDSOHe0uPPpJjx3RIYtHS', 1, NULL, NULL, '2024-05-23 05:13:44', '2024-05-23 12:14:27'),
(2, 'Fahmi', 'muhammad.fahmi14999@gmail.com', '857770249760', '2024-05-23 15:05:12', '$2y$10$1NDMKRoCnOaHZEgYNXDSmeINRvZtmE1yj582LLLxCxQVXRqBsdXFy', 2, NULL, NULL, '2024-05-23 08:04:37', '2024-05-23 15:05:12');

-- --------------------------------------------------------

--
-- Table structure for table `user_devices`
--

CREATE TABLE `user_devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `device_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_status` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_devices`
--

INSERT INTO `user_devices` (`id`, `user_id`, `device_id`, `name`, `last_status`, `created_at`, `updated_at`) VALUES
(1, 2, 12, 'Ruang Tamu', 'OFF', NULL, '2024-08-07 17:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `user_device_schedules`
--

CREATE TABLE `user_device_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_device_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `scheduled_time` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_device_schedules`
--

INSERT INTO `user_device_schedules` (`id`, `user_device_id`, `action`, `scheduled_time`, `created_at`, `updated_at`) VALUES
(40, 1, 'ON', '00:36', '2024-08-07 17:40:43', '2024-08-07 17:40:43'),
(41, 1, 'OFF', '00:45', '2024-08-07 17:40:43', '2024-08-07 17:40:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `devices_device_id_unique` (`device_id`);

--
-- Indexes for table `device_categories`
--
ALTER TABLE `device_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_sensors`
--
ALTER TABLE `device_sensors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sensors`
--
ALTER TABLE `sensors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sensors_name_unique` (`name`);

--
-- Indexes for table `sensor_parameters`
--
ALTER TABLE `sensor_parameters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_whatsapp_unique` (`whatsapp`);

--
-- Indexes for table `user_devices`
--
ALTER TABLE `user_devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_device_schedules`
--
ALTER TABLE `user_device_schedules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `device_categories`
--
ALTER TABLE `device_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `device_sensors`
--
ALTER TABLE `device_sensors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sensors`
--
ALTER TABLE `sensors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sensor_parameters`
--
ALTER TABLE `sensor_parameters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_devices`
--
ALTER TABLE `user_devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_device_schedules`
--
ALTER TABLE `user_device_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
