<?php

require "vendor/autoload.php";

// Initialise objects.
$boxHelper = new Reval\BoxHelper();

// Read data.
$orders = file_get_contents('data/orders.json');
$boxes = file_get_contents('data/boxes.json');

// Decode data.
$orders = json_decode($orders, true);
$boxes = json_decode($boxes, true);

// Calculate volume of boxes.
foreach ($boxes as $key => $box) {
    $boxes[$key]['volumeCm3'] = $boxHelper->calculateVolumeInCm3($box);
}

// Sort boxes by volume to help cut down loops later.
$boxes = $boxHelper->sortBoxesByVolume($boxes);

// Process each order.
foreach ($orders as $key => $order) {
    // Calculate order volume.
    $ingredientsVolume = array_column($order['ingredients'], 'volumeCm3');
    $orderVolume = array_sum($ingredientsVolume);

    // Assign smallest box.
    foreach ($boxes as $box) {
        if ($orderVolume <= $box['volumeCm3']) {
            $orders[$key]['box'] = $box['id'];
            $orders[$key]['co2FootprintKg'] = $box['co2FootprintKg'];
            break;
        }
    }
}

// Prepare data for output.
$totalCo2FootprintForAllOrders = array_sum(array_column($orders, 'co2FootprintKg'));
$largestBox = end($boxes);
$totalCo2FootprintForAllOrdersWithLargestBox = count($orders) * $largestBox['co2FootprintKg'];
$co2FootprintKgSaving = $totalCo2FootprintForAllOrdersWithLargestBox - $totalCo2FootprintForAllOrders;
$co2SavingAnswer = $co2FootprintKgSaving > 1000 ? 'Yes' : 'No';

// Output.
echo "Sum of the CO2 footprint per box for every order in the file: " . $totalCo2FootprintForAllOrders . "kg";
echo "\n";
echo "Sum of the CO2 footprint if every order would be in the largest box we have: "
    . $totalCo2FootprintForAllOrdersWithLargestBox . "kg";
echo "\n";
echo "Have we saved 1000kg of CO2? " . $co2SavingAnswer;
echo "\n";

echo "Orders with assigned boxes:";
echo "\n";
foreach ($orders as $order) {
    echo "Order " . $order['id'] . " has been matched with" . " BoxHelper: " . $order['box'];
    echo "\n";
}