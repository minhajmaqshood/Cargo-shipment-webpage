# Cargo-shipment-webpage
Got it 👍 You’re building a **Cargo Shipment Management Web Application**. Let me give you a **clear explanation and a project view (workflow + required pages + data flow)** so you can plan the project properly.

---

## 🔹 Project Overview: Cargo Shipment Management System

A **Cargo Shipment Webpage** (or full web app) is used to manage and track shipments, products, shipping marks, CBM, and documents. It allows staff and clients to **enter shipment details, view dashboards, upload documents, and track shipment status**.

---

## 🔹 Core Pages & Flow

### 1. **Login & Role-based Access**

* **Purpose**: Control access (Admin, Staff, Client).
* **Features**:

  * Email/username + password login.
  * Role-based dashboard access (admin sees everything, staff can enter/edit data, clients only view status).

---

### 2. **Dashboard Page**

* **Purpose**: Central hub with all shipment info.
* **Features**:

  * Overview of shipments grouped by **Shipping Mark**.
  * Totals of **CBM**, **Weight**, and **Box Count**.
  * Filter by date, shipment name, status.
  * Quick buttons: **View / Edit / Delete / Out (status update)**.

---

### 3. **Shipment Entry Page**

* **Purpose**: Enter new shipment details.
* **Fields**:

  * Shipment Name
  * Shipping Mark
  * Product Name
  * Dimensions (Length × Width × Height)
  * CBM (auto-calculated from dimensions)
  * Weight
  * Box Count
  * Upload Invoice / Packing List
* **Actions**: Save → Data stored in MySQL.

---

### 4. **Shipment Details Page**

* **Purpose**: View details of a single shipment.
* **Features**:

  * List of all products under the shipment.
  * Subtotals of weight, CBM, and boxes.
  * Uploaded documents.

---

### 5. **Edit / Delete Page**

* **Purpose**: Update shipment/product details or remove them.
* **Features**:

  * Edit form pre-filled with existing data.
  * Delete confirmation popup.

---

### 6. **Document Upload & View Page**

* **Purpose**: Upload, manage, and view documents.
* **Supported Files**: Invoice, Packing List, BL (Bill of Lading), Airway Bill, etc.
* **Access**: Staff/Admin can upload, Client can view.

---

### 7. **Status Tracking Page**

* **Purpose**: Show current shipment status.
* **Statuses**: Pending, In Progress, Out, Delivered.
* **Features**:

  * “Mark as Out” button → Updates backend with timestamp.
  * Clients can check shipment status using shipment number.

---

### 8. **Analytics & Reports Page**

* **Purpose**: Show shipment trends & reports.
* **Features**:

  * Charts (CBM vs Weight, Monthly Shipments, Top Clients).
  * Export to Excel/PDF.

---

## 🔹 Data Flow (How it Works)

1. **Data Entry** → User enters shipment details → Stored in MySQL.
2. **Dashboard** → Fetches data from database → Groups by shipping mark.
3. **Calculations** → CBM, Weight, Box Count auto-calculated and shown in dashboard.
4. **Documents** → Uploaded files saved in server folder → Linked to shipment in DB.
5. **Status Update** → Staff clicks “Out” → Backend updates record with timestamp.
6. **Reports/Analytics** → Aggregates DB data → Shown in charts and downloadable reports.

---

## 🔹 Suggested Project Page Flow (Frontend)

1. **index.php** → Login
2. **dashboard.php** → Overview of shipments
3. **add\_shipment.php** → Enter shipment data
4. **shipment\_details.php** → View single shipment
5. **edit\_shipment.php** → Edit/Delete shipment data
6. **documents.php** → Upload/view docs
7. **status.php** → Track shipment progress
8. **analytics.php** → Reports & charts

---

⚡ So in short:

* **Entry Page** → Enter Data
* **Dashboard** → View all grouped data
* **Details Page** → Drill-down view
* **Edit/Delete** → Manage shipment data
* **Document Page** → Upload files
* **Status Page** → Track shipment
* **Analytics Page** → Charts & reports

---

<img width="1900" height="1318" alt="image" src="https://github.com/user-attachments/assets/603b2017-d0b8-43ff-9569-0baffd8a0973" />

Here’s the **folder & file structure diagram** for your Cargo Shipment Web App:

* **project\_root/** (main folder)

  * `index.php` → Login page
  * `dashboard.php` → Dashboard overview
  * `add_shipment.php` → Shipment entry form
  * `shipment_details.php` → Detailed view of shipments
  * `edit_shipment.php` → Edit/Delete shipment
  * `documents.php` → Upload/view shipment documents
  * `status.php` → Track shipment status
  * `analytics.php` → Reports & charts
  * **config/** (settings folder)

    * `db.php` → Database connection
    * `auth.php` → Role management & authentication

Here’s the **MySQL database schema diagram** for your Cargo Shipment System:

* **users** → stores login accounts & roles.
* **shipments** → main shipment records (shipment name, shipping mark, status).
* **products** → linked to shipments (with dimensions, weight, CBM, boxes).
* **documents** → linked to shipments (invoice, packing list, etc.).
* **status\_log** → tracks status updates with timestamp & user ID.
Got it ✅ — here’s how we can structure the **Admin Dashboard with role management** for your Cargo Shipment System:

---

## 🔑 Admin Dashboard Features

Admin has **full access** to:

1. **Manage Shipments & Products** (create, edit, delete).
2. **Manage Ground Staff** (add staff accounts, assign role = `staff`).
3. **Manage Clients** (create client logins with read-only access).
4. **Permissions Control** (decide what staff can edit, what clients can only view).
5. **Analytics & Reports** (view shipment totals, CBM, weight, etc.).

---

## 👷 Staff Dashboard Features (Ground-level employees)

* Can **log in**.
* Can **add new shipments/products**.
* Can **mark product OUT** (logs date & time).
* **No delete or edit of shipments** (only limited fields).

---

## 👨‍💼 Client Dashboard Features

* **Log in** with their own credentials.
* **View their shipments** (linked via `client_id` in `shipments` table).
* Can **download documents** (Invoice, Packing List, etc.).
* **No edit/delete permissions**.

---

## 📊 Database Update (New Tables/Columns)

To support this, we add:

```sql
-- Users Table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','staff','client') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Shipments linked to client
ALTER TABLE shipments ADD COLUMN client_id INT NULL,
    ADD CONSTRAINT fk_client FOREIGN KEY (client_id) REFERENCES users(user_id);
```

---

## 📌 Flow of Access

* **Admin** → Manages everything.
* **Staff** → Admin assigns login → can access shipment entry & product out log.
* **Client** → Admin assigns login → can only view their shipments.

---

## 🖥️ Admin Dashboard (Sample UI Sections)

* **User Management**:

  * Add New User (role = staff or client).
  * Assign permissions.
  * Reset passwords.
* **Shipment Management**:

  * Create/Edit/Delete shipments.
* **Analytics**:

  * Total Shipments, Status Report, Document Summary.

---
