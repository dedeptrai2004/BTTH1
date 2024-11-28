<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Trị Hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold text-center text-blue-600 mb-8">Quản Trị Các Loài Hoa</h1>
        <div class="flex justify-center mb-8">
            <button onclick="location.href='user.php'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Quay về Trang Người Dùng Khách</button>
        </div>
        <form action="admin.php" method="POST" enctype="multipart/form-data">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="w-1/4 py-3 px-4 text-left">Tên Hoa</th>
                            <th class="w-1/2 py-3 px-4 text-left">Mô Tả</th>
                            <th class="w-1/4 py-3 px-4 text-left">Hình Ảnh</th>
                            <th class="w-1/4 py-3 px-4 text-left">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'data.php';
                        foreach ($flowers as $index => $flower) {
                            echo '<tr class="border-b hover:bg-gray-100">';
                            echo '<td class="py-3 px-4"><input type="text" name="name[]" value="' . $flower['name'] . '" class="border rounded w-full py-2 px-3"></td>';
                            echo '<td class="py-3 px-4"><textarea name="description[]" class="border rounded w-full py-2 px-3">' . $flower['description'] . '</textarea></td>';
                            echo '<td class="py-3 px-4"><img src="' . $flower['image'] . '" alt="' . $flower['name'] . '" class="max-w-full h-auto rounded"></td>';
                            echo '<td class="py-3 px-4 flex space-x-2">';
                            echo '<button type="submit" name="edit" value="' . $index . '" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Sửa</button>';
                            echo '<button type="submit" name="delete" value="' . $index . '" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Xóa</button>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-4"><input type="text" name="new_name" class="border rounded w-full py-2 px-3"></td>
                            <td class="py-3 px-4"><textarea name="new_description" class="border rounded w-full py-2 px-3"></textarea></td>
                            <td class="py-3 px-4"><input type="file" name="new_image" accept="image/*" class="border rounded w-full py-2 px-3"></td>
                            <td class="py-3 px-4"><button type="submit" name="add" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Thêm</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'data.php';
    if (isset($_POST['add'])) {
        $newFlower = [
            'name' => $_POST['new_name'],
            'description' => $_POST['new_description'],
            'image' => 'images/' . basename($_FILES['new_image']['name'])
        ];
        move_uploaded_file($_FILES['new_image']['tmp_name'], $newFlower['image']);
        $flowers[] = $newFlower;
    } elseif (isset($_POST['edit'])) {
        $index = $_POST['edit'];
        $flowers[$index]['name'] = $_POST['name'][$index];
        $flowers[$index]['description'] = $_POST['description'][$index];
    } elseif (isset($_POST['delete'])) {
        $index = $_POST['delete'];
        array_splice($flowers, $index, 1);
    }
    // Lưu dữ liệu vào data.php
    file_put_contents('data.php', '<?php $flowers = ' . var_export($flowers, true) . '; ?>');
    header('Location: admin.php');
}
?>