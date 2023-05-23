<?php
// Подключение к базе данных (код для подключения см. в предыдущем примере)

// Получение ID текущего пользователя (предполагается, что у вас уже есть механизм аутентификации и ID пользователя доступен)

$currentUserId = 1; // Здесь должно быть ваше значение для ID текущего пользователя

// Получение ID кампании из параметра URL
if (isset($_GET["campaign_id"])) {
    $campaignId = $_GET["campaign_id"];

    // Проверка, не является ли пользователь уже участником кампании
    $sql = "SELECT * FROM characters WHERE user_id = ? AND campaigning_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $currentUserId, $campaignId);
    $stmt->execute();
    $result = $stmt->get_result();
    $character = $result->fetch_assoc();
    $stmt->close();

    if (!$character) {
        // Создание нового персонажа в кампании
        $sql = "INSERT INTO characters (user_id, campaigning_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $currentUserId, $campaignId);
        $stmt->execute();
        $stmt->close();
    }
}

// Закрытие соединения с базой данных (код для закрытия соединения см. в предыдущем примере)
?>
