create database KDT;
use KDT ; 

-- Tạo bảng BenhNhan
CREATE TABLE BenhNhan (
  id_benhnhan INT PRIMARY KEY AUTO_INCREMENT,
  HoTenBN VARCHAR(50),
  NgaySinh DATE,
  GioiTinh VARCHAR(10),
  DiaChi VARCHAR(100)
);

-- Tạo bảng BacSi
CREATE TABLE BacSi (
  id_bacsi INT PRIMARY KEY AUTO_INCREMENT,
  HoTenBS VARCHAR(50),
  ChuyenMon VARCHAR(50),
  SDT VARCHAR(10)
);

-- Tạo bảng DonThuoc
CREATE TABLE DonThuoc (
  id_donthuoc INT PRIMARY KEY AUTO_INCREMENT,
  id_benhnhan INT,
  id_bacsi INT,
  NgayKeDon DATE,
  FOREIGN KEY (id_benhnhan) REFERENCES BenhNhan(id_benhnhan),
  FOREIGN KEY (id_bacsi) REFERENCES BacSi(id_bacsi)
);

-- Tạo bảng LieuLuong
CREATE TABLE LieuLuong (
  id_lieuluong INT PRIMARY KEY AUTO_INCREMENT,
  TenThuoc VARCHAR(50),
  min_single_dose INT,
  max_single_dose INT,
  min_daily_dose INT,
  max_daily_dose INT,
  min_period_dose INT,
  max_period_dose INT
);

-- Tạo bảng ChiTietKeDon
CREATE TABLE ChiTietKeDon (
  id_chitietkedon INT PRIMARY KEY AUTO_INCREMENT,
  id_donthuoc INT,
  id_lieuluong INT,
  dose DECIMAL(5, 2),
  FOREIGN KEY (id_donthuoc) REFERENCES DonThuoc(id_donthuoc),
  FOREIGN KEY (id_lieuluong) REFERENCES LieuLuong(id_lieuluong)
);

-- Gen data cho bảng BenhNhan
INSERT INTO BenhNhan (HoTenBN, NgaySinh, GioiTinh, DiaChi)
SELECT
  CONCAT('BenhNhan ', seq),
  DATE_SUB(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 90) YEAR),
  CASE WHEN RAND() < 0.5 THEN 'Nam' ELSE 'Nữ' END,
  CONCAT('Địa chỉ ', seq)
FROM
  (SELECT @rownum:=@rownum+1 AS seq
   FROM (SELECT 0 UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
         UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6
         UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) t,
        (SELECT 0 UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
         UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6
         UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) t2,
        (SELECT @rownum:=0) r
  ) seq_table
LIMIT 10;

--  Gen data cho bảng BacSi
INSERT INTO BacSi (HoTenBS, ChuyenMon, SDT)
SELECT
  CONCAT('BacSi ', seq),
  CONCAT('Chuyên môn ', seq),
    CONCAT(
    FLOOR(RAND() * 0),
    FLOOR(RAND() * 10),
    FLOOR(RAND() * 10),
    FLOOR(RAND() * 10),
    FLOOR(RAND() * 10),
    FLOOR(RAND() * 10),
    FLOOR(RAND() * 10),
    FLOOR(RAND() * 10),
    FLOOR(RAND() * 10),
    FLOOR(RAND() * 10)
  )
FROM
  (SELECT @rownum:=@rownum+1 AS seq
   FROM (SELECT 0 UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
         UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6
         UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) t,
        (SELECT 0 UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
         UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6
         UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) t2,
        (SELECT @rownum:=0) r
  ) seq_table
LIMIT 5;

--  Gen data cho bảng DonThuoc
INSERT INTO DonThuoc (id_benhnhan, id_bacsi, NgayKeDon)
SELECT
  FLOOR(RAND() * 10) + 1,
  FLOOR(RAND() * 5) + 1,
  DATE_SUB(CURRENT_DATE(), INTERVAL FLOOR(RAND() * 30) DAY)
FROM
  (SELECT @rownum:=@rownum+1 AS seq
   FROM (SELECT 0 UNION ALL SELECT 1 UNION ALL SELECT 2 UNION all SELECT 3
UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6
UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) t,
(SELECT 0 UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6
UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) t2,
(SELECT @rownum:=0) r
) seq_table
LIMIT 10;

--  Gen data cho bảng LieuLuong
INSERT INTO LieuLuong (TenThuoc, min_single_dose, max_single_dose, min_daily_dose, max_daily_dose, min_period_dose, max_period_dose)
SELECT
CONCAT('Thuoc ', seq),
FLOOR(RAND() * 10) + 1,
FLOOR(RAND() * 20) + 10,
FLOOR(RAND() * 50) + 10,
FLOOR(RAND() * 100) + 50,
FLOOR(RAND() * 5) + 1,
FLOOR(RAND() * 10) + 5
FROM
(SELECT @rownum:=@rownum+1 AS seq
FROM (SELECT 0 UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6
UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) t,
(SELECT 0 UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6
UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) t2,
(SELECT @rownum:=0) r
) seq_table
LIMIT 20;

--  Gen data cho bảng ChiTietKeDon
INSERT INTO ChiTietKeDon (id_donthuoc, id_lieuluong, dose)
SELECT
FLOOR(RAND() * 10) + 1,
FLOOR(RAND() * 20) + 1,
ROUND(RAND() * (max_single_dose - min_single_dose) + min_single_dose, 2)
FROM DonThuoc, LieuLuong
ORDER BY RAND()
LIMIT 50;