<?php

use database\Restaurant;

if (isset($_POST['back'])) {
    home();
}

if (isset($_GET['id']))
    $id = $_GET['id'];
else
    home();

function home()
{
    header('Location: boekingen.php');
    exit();
}
?>
<?php include "include/nav_boekingen.php"; ?>
<?php
$db = new database\Database("localhost", "root", "", "donkey", null);

$boekingen = $db->getBoekingByID($id);
$pauzeplaatsen = $db->getPauzeplaatsByBoekingID($id);
$restaurants = $db->getRestaurants();

if (isset($_POST['save']) && isset($_POST['restaurants'])) {
    // Post data:
    // - restaurants[]

    //var_dump($_POST['restaurants']);
    // return all ids from $restaurants using ->getID()
    array_map(function ($restaurant) use ($db, $id) {
        if (in_array($restaurant->getID(), $_POST['restaurants'], false))
        {
            // check if pauzeplaatsen already has an entry with this restaurant
            $pauzeplaats = $db->getPauzeplaatsenByRestaurantID($restaurant->getID(), $id);
            if (is_null($pauzeplaats) || count($pauzeplaats) == 0) {
                $db->setPauzeplaats(null, $id, $restaurant->getID(), 1);
            }
        }
        else
        {
            $pauzeplaats = $db->getPauzeplaatsenByRestaurantID($restaurant->getID(), $id);
            if (!is_null($pauzeplaats) && count($pauzeplaats) > 0) {
                $db->deletePauzeplaats($pauzeplaats[0]->getID());
            }
        }
    }, $restaurants);
    header('Location: pauzeplaatsen_beheer.php?id=' . $id);
    exit();
}

?>
<h3>Pauzeplaatsen</h3>
<br />
<form action="" method="post">
    <div class="row g-2">
        <div class="col-sm-6 h-fc">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Restaurant</th>
                        <th>Adres</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="table1" class="connectedSortable min-height">
                    <?php
                    $ids = array();
                    foreach ($pauzeplaatsen as $pauzeplaats) {
                        array_push($ids, $pauzeplaats->getID());
                    ?>
                        <tr>
                            <input type="hidden" name="restaurants[]" value="<?php echo $pauzeplaats->getRestaurant()->getID(); ?>">
                            <td><i class="fa-solid fa-ellipsis-vertical"></i></td>
                            <td><?php echo $pauzeplaats->getRestaurant()->getNaam(); ?></td>
                            <td class="w-fc"><?php echo $pauzeplaats->getRestaurant()->getAdres(); ?></td>
                            <td><?php echo $pauzeplaats->getStatus()->getStatus(); ?></td>
                            <td>
                                <button type="button" class="float-start addbutton" style="display: none;"><i class="fa-solid fa-plus"></i></button>
                                <button type="button" class="float-start"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button type="button" class="float-start removebutton"><i class="fa-solid fa-minus"></i></button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr class="unsortable" style="display: none;">
                        <td colspan="5"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-6 h-fc">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Restaurant</th>
                        <th>Adres</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="table2" class="connectedSortable min-height">
                    <?php
                    foreach ($restaurants as $restaurants) {
                        if (in_array($restaurants->getID(), $ids)) continue;
                    ?>
                        <tr>
                            <input type="hidden" name="restaurants[]" value="<?php echo $restaurants->getID(); ?>" disabled>
                            <td><i class="fa-solid fa-ellipsis-vertical"></i></td>
                            <td><?php echo $restaurants->getNaam(); ?></td>
                            <td><?php echo $restaurants->getAdres(); ?></td>
                            <td style="display: none;"></td>
                            <td>
                                <button type="button" class="float-start addbutton" onclick=""><i class="fa-solid fa-plus"></i></button>
                                <button type="button" class="float-start" style="display: none;"><i class=" fa-solid fa-pen-to-square"></i></button>
                                <button type="button" class="float-start removebutton" style="display: none;"><i class="fa-solid fa-minus"></i></button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr class="unsortable" style="display: none;">
                        <td colspan="4"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br />
    <button type="submit" name="save" class="btn btn-success">Bewaren</button>
    <button type="submit" name="back" class="btn btn-primary">Terug</button>
</form>
<script src="./js/dragtable.js"></script>
<?php include "include/footer.php"; ?>