<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add Shipment</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
  <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Add Shipment</h2>
    <form action="insert.php" method="POST" enctype="multipart/form-data" class="space-y-4">
      <input type="text" name="shipment_name" placeholder="Shipment Name" required class="w-full p-2 border rounded" />
      <input type="text" name="shipping_mark" placeholder="Shipping Mark" required class="w-full p-2 border rounded" />
      <input type="text" name="product_name" placeholder="Product Name" required class="w-full p-2 border rounded" />

      <div class="grid grid-cols-3 gap-4">
        <input type="number" step="0.01" name="length" placeholder="Length (cm)" required class="p-2 border rounded" />
        <input type="number" step="0.01" name="width" placeholder="Width (cm)" required class="p-2 border rounded" />
        <input type="number" step="0.01" name="height" placeholder="Height (cm)" required class="p-2 border rounded" />
      </div>

      <input type="number" step="0.01" name="weight" placeholder="Weight (kg)" required class="w-full p-2 border rounded" />
      <input type="number" name="boxes" placeholder="Number of Boxes" required class="w-full p-2 border rounded" />

      <label class="block">Upload Invoice or Docs:</label>
      <input type="file" name="document" accept=".pdf,.jpg,.png" class="w-full p-2 border rounded" />

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Submit</button>
    </form>
  </div>
</body>
</html>
