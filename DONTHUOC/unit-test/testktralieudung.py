import unittest
from ktralieudung import Medication, check_dose

class TestCheckDose(unittest.TestCase):
    def test_lieu_dung_hop_le(self):
        medication = Medication("Thuoc A", 10)
        prescribed_dose = 8
        result, message = check_dose(medication, prescribed_dose)
        self.assertTrue(result)
        self.assertEqual(message, "Lieu dung 10 la hop le voi thuoc Thuoc A")

    def test_lieu_dung_vuot_qua_chuan(self):
        medication = Medication("Thuoc B", 5)
        prescribed_dose = 6
        result, message = check_dose(medication, prescribed_dose)
        self.assertFalse(result)
        self.assertEqual(message, "Lieu dung vuot qua chuan cho phep.")

    def test_lieu_dung_khong_hop_le(self):
        medication = Medication("Thuoc C", 15)
        prescribed_dose = -2
        result, message = check_dose(medication, prescribed_dose)
        self.assertFalse(result)
        self.assertEqual(message, "Lieu dung khong hop le.")

    def test_lieu_dung_vuot_qua_nguong(self):
        medication = Medication("Thuoc D", 20)
        prescribed_dose = 1001
        result, message = check_dose(medication, prescribed_dose)
        self.assertFalse(result)
        self.assertEqual(message, "Lieu dung khong hop le.")

if __name__ == '__main__':
    unittest.main()
