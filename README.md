# 🏥 Healthcare Management System (HMS)

A full-stack Healthcare Management System built using **PHP**, **MySQL**, **HTML**, **CSS**, and **JavaScript**. This system allows hospitals and clinics to manage patient registrations, appointment scheduling, medical records, billing, and staff roles effectively through a secure, role-based login system.

---

## Technologies Used

- **PHP** – Backend scripting
- **MySQL** – Database for storing records
- **HTML5 & CSS3** – Frontend structure and styling
- **JavaScript** – Frontend validation and interactivity
- **XAMPP** – Local development server

---

## Project Structure

| Folder Name           | Description |
|-----------------------|-------------|
| `appointment_scheduling/` | Booking and managing appointments between patients and doctors. |
| `billing/`                | Generating invoices, calculating totals, and marking payments. |
| `login/`                  | User login, session handling, and access control for all roles. |
| `medical_records/`        | Submission of nurse notes and doctor diagnoses for each patient visit. |
| `patient_registration/`   | New patient sign-up and storing personal details. |
| `SQL/`                    | MySQL `.sql` scripts to set up database tables and sample data. |

---

## Supported Roles

- **Admin Staff**: Register patients, manage billing, and book appointments.
- **Nurse**: Record initial vitals and patient notes.
- **Doctor**: View nurse inputs and submit diagnosis/treatment plans.
- **Patient**: Register, log in, view appointments and statuses.

---

## Key Features

- User authentication with role-based dashboards
- Appointment scheduling system with fulfillment status
- Medical records tracking (nurse + doctor)
- Billing calculation per visit
- Support for both booked and walk-in patients
- Status checkboxes to track full visit progress

---

## How to Run This Project (Localhost)

1. **Download & install XAMPP** if you haven’t already.
2. Copy this project folder into your `htdocs/` directory.
3. Open **phpMyAdmin** and import the SQL file from the `/SQL/` folder.
4. Start **Apache** and **MySQL** in XAMPP control panel.
5. Open your browser and go to:  
   `http://localhost/healthcare-management-system/login/`
6. Log in using sample credentials from the `users` table or register a new patient.

---

## Future Improvements

- Email/SMS appointment reminders
- Exportable PDF invoices and medical records
- Role-based dashboards with analytics
- Responsive mobile-friendly UI



