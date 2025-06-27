<?php
$hashedPassword = '';
$uuid = '';

function generateUUIDv4(): string
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000, // 4 for version 4
        mt_rand(0, 0x3fff) | 0x8000, // 8, 9, A, or B for variant
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plainText = $_POST['plain_text'] ?? '';

    if (!empty($plainText)) {
        $hashedPassword = password_hash($plainText, PASSWORD_DEFAULT);
    }

    // Always generate a UUID
    $uuid = generateUUIDv4();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hash Password & Generate UUID</title>
</head>

<body>
    <h2>Generate Hashed Password and UUID</h2>
    <form method="post">
        <label for="plain_text">Enter Plain Text:</label><br>
        <input type="text" name="plain_text" id="plain_text" required><br><br>
        <input type="submit" value="Generate">
    </form>

    <?php if (!empty($hashedPassword)): ?>
        <h3>Hashed Password:</h3>
        <textarea rows="2" cols="80" readonly><?php echo htmlspecialchars($hashedPassword); ?></textarea>
    <?php endif; ?>

    <?php if (!empty($uuid)): ?>
        <h3>Generated UUID v4:</h3>
        <input type="text" size="40" readonly value="<?php echo $uuid; ?>">
    <?php endif; ?>
</body>

</html>