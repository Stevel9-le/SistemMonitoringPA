# TODO List for Final Project Monitoring System

## 1. Create Models and Migrations
- [x] Create Project model with fields: title, description, status, start_date, end_date, assigned_staff_id
- [x] Create Staff model with fields: name, role, email, user_id (link to User)
- [x] Generate migrations for projects and staff tables

## 2. Create Controllers
- [x] Create ProjectController with CRUD methods (index, create, store, show, edit, update, destroy)
- [x] Create StaffController with CRUD methods
- [x] Create DashboardController to fetch and display statistics

## 3. Update Dashboard View
- [x] Modify resources/views/admin/dashboard.blade.php to show project metrics (total projects, running projects, completed projects, staff count)

## 4. Add Routes
- [x] Update routes/web.php to include routes for projects, staff, and dashboard with auth middleware

## 5. Update Layouts and Views
- [x] Update resources/views/layouts/sidebar.blade.php to add navigation for projects and staff
- [x] Create Blade views for project CRUD (index, create, edit)
- [x] Create Blade views for staff CRUD (index, create, edit)

## 6. Additional Features
- [x] Implement form validation in controllers
- [x] Add role-based access (admin vs staff)
- [x] Run migrations and test the system
