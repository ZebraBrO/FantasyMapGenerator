<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ttrpg";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение ID текущего пользователя (предполагается, что у вас уже есть механизм аутентификации и ID пользователя доступен)

$currentUserId = 1; // Здесь должно быть ваше значение для ID текущего пользователя

// Функция для создания новой кампании
function createCampaign($name, $description, $mapSeed, $ownerId)
{
    global $conn;
    $sql = "INSERT INTO campaignings (name, description, map_seed, owner_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $description, $mapSeed, $ownerId);
    $stmt->execute();
    $stmt->close();
}

// Функция для добавления персонажа в кампанию
function addCharacterToCampaign($characterId, $campaignId)
{
    global $conn;
    $sql = "UPDATE characters SET campaigning_id = ? WHERE character_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $campaignId, $characterId);
    $stmt->execute();
    $stmt->close();
}

// Обработка формы создания кампании
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["create_campaign"])) {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $mapSeed = $_POST["map_seed"];

    // Создание новой кампании
    createCampaign($name, $description, $mapSeed, $currentUserId);
}

// Получение списка кампаний, связанных с пользователем
$sql = "SELECT * FROM campaignings WHERE owner_id = ? OR EXISTS (SELECT 1 FROM characters WHERE campaigning_id = campaignings.campaigning_id AND user_id = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $currentUserId, $currentUserId);
$stmt->execute();
$result = $stmt->get_result();
$campaigns = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Закрытие соединения с базой данных
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Список кампаний</title>
</head>
<body>
    <h1>Список кампаний</h1>

    <!-- Форма для создания кампании -->
    <h2>Создать кампанию</h2>
    <form method="post" action="">
        <label for="name">Название: </label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="description">Описание: </label>
        <textarea id="description" name="description"></textarea>
        <br>
        <label for="map_seed">Сид карты: </label>
        <input type="text" id="map_seed" name="map_seed" required>
        <br>
        <input type="submit" name="create_campaign" value="Создать">
    </form>

    <!-- Отображение списка кампаний -->
    <h2>Мои кампании</h2>
    <ul>
        <?php foreach ($campaigns as $campaign) { ?>
            <li>
                <strong><?php echo $campaign["name"]; ?></strong><br>
                <?php echo $campaign["description"]; ?><br>
                <a href="join_campaign.php?campaign_id=<?php echo $campaign["campaigning_id"]; ?>">Присоединиться</a>
            </li>
        <?php } ?>
    </ul>
</body>
</html>
