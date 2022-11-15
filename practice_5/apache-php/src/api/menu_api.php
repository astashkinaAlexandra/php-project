<?php require_once '../_helper.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        addItem();
        break;
    case 'DELETE':
        removeItemByName();
        break;
    case 'PATCH':
        updateItemCostByName();
        break;
    case 'GET':
        getItemByName();
        break;
    default:
        outputStatus(2, 'Invalid Mode');
}

function addItem()
{
    $mysqli = openMysqli();
    $data = file_get_contents('php://input');
    $data = json_decode($data, true);
    $dishName = $data['name'];
    $dishDesc = $data['desc'];
    $dishCost = $data['cost'];
    $result = $mysqli->query("SELECT * FROM dishes WHERE title = '{$dishName}';");
    if ($result->num_rows === 1) {
        $message = $dishName . ' already exists';
        outputStatus(1, $message);
    } else {
        $query = "INSERT INTO dishes (title, description, cost)
        VALUES ('" . $dishName . "', '" . $dishDesc . "', " . $dishCost . ");";
        $mysqli->query($query);
        $mysqli->close();
        $message = 'Added ' . $dishName . ' with cost of ' . $dishCost;
        outputStatus(0, $message);
    }
}

function removeItemByName()
{
    $mysqli = openMysqli();
    $dishName = $_GET['name'];
    $result = $mysqli->query("SELECT * FROM dishes WHERE title = '{$dishName}';");
    if ($result->num_rows === 1) {
        $query = "DELETE FROM dishes WHERE title = '" . $dishName . "';";
        $mysqli->query($query);
        $mysqli->close();
        $message = 'Removed ' . $dishName;
        outputStatus(0, $message);
    } else {
        $message = $dishName . ' does not exist';
        outputStatus(1, $message);
    }
}

function updateItemCostByName()
{
    $mysqli = openMysqli();
    $data = file_get_contents('php://input');
    $data = json_decode($data, true);
    $dishName = $data['name'];
    $dishCost = $data['cost'];
    $result = $mysqli->query("SELECT * FROM dishes WHERE title = '{$dishName}';");
    if ($result->num_rows === 1) {
        $query = "UPDATE dishes SET cost = " . $dishCost . " WHERE title = '" . $dishName . "';";
        $mysqli->query($query);
        $mysqli->close();
        $message = 'Updated ' . $dishName . ' with cost of ' . $dishCost;
        outputStatus(0, $message);
    } else {
        $message = $dishName . ' does not exist';
        outputStatus(1, $message);
    }
}

function getItemByName()
{
    $mysqli = openMysqli();
    if (isset($_GET['name'])) {
        $dishName = $_GET['name'];
        $query = "SELECT * FROM dishes WHERE title = '{$dishName}';";
        $result = $mysqli->query($query);
        if ($result->num_rows === 1) {
            foreach ($result as $dish) {
                echo "{status: 0, name: '" . $dish['title'] . "', description: '" . $dish['description'] . "', cost: " . $dish['cost'] . "}";
            }
            $mysqli->close();
        } else {
            $message = $dishName . ' does not exist';
            outputStatus(1, $message);
        }
    } else {
        $result = $mysqli->query("SELECT * FROM dishes;");
        foreach ($result as $dish) {
            echo "{status: 0, name: '" . $dish['title'] . "', description: '" . $dish['description'] . "', cost: " . $dish['cost'] . "}";
        }
        $mysqli->close();
    }
}

?>