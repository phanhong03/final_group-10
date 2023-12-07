class Medication:
    def __init__(self, name, dosage):
        self.name = name
        self.dosage = dosage

def check_dose(medication, prescribed_dose):
    if prescribed_dose <= 0 or prescribed_dose > 1000:
        return False, "Lieu dung khong hop le."
    
    if prescribed_dose > medication.dosage:
        return False, "Lieu dung vuot qua chuan cho phep."
    
    return True, "Lieu dung {} la hop le voi thuoc {}".format(medication.dosage, medication.name)