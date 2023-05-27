# Optimise Delivery Code Task (3hr time limit)

## Contents
1. [Task Description](#task-description)
2. [My Solution](#my-solution)
3. [Future Improvements](#future-improvements)

## Task Description
At The Meal Delivery Company we send boxes of ingredients to customers to cook at home and create their perfect dinner. Customers are able to choose multiple recipes for a different number of people. This means the number of ingredients in a box can vary, and the volume of those ingredients can vary by even more.
In this kata you'll be given two JSON files.
1. [`boxes.json`](data/boxes.json) - This contains an array of different box sizes available for us to send an order in. Each box will have an ID, dimensions and a CO2 footprint value.
2. [`orders.json`](data/orders.json) - This contains an array of orders, each order contains an ID and an array of ingredients. These ingredients will have a volume score.

### Expected Output
- Write a script which takes these two files, processes them and determines the smallest possible box that the order will fit into
- Output the sum of the CO2 footprint per box for every order in the file
- Output the sum of the CO2 footprint if every order would be in the largest box we have.
- Have we saved 1000kg of CO2?
- Output a list of the order IDs and the IDs of the boxes you've matched against them.

### The Rules
1. Spend around 4 hours on this, don't feel you have to rush a solution.
2. Tests are not a hard requirement but are strongly encouraged.

## My Solution
- The script reads the JSON files and converts the data into multidimensional arrays.
- It calculates the volume of each box and sorts the array of boxes based on volume.
- A loop is used to process each order, calculating the order's volume and assigning the smallest box available.
- By having a sorted array of boxes, the number of iterations through the boxes array is minimised.
- PHP's native array functions are utilized to reduce nesting loops for improved performance at scale.

```
/usr/bin/php /home/revalgovender/PhpstormProjects/php-code-kata/main.php
Sum of the CO2 footprint per box for every order in the file: 1700kg
Sum of the CO2 footprint if every order would be in the largest box we have: 3000kg
Have we saved 1000kg of CO2? Yes
Orders with assigned boxes:
Order 1 has been matched with BoxHelper: PK-MED-01
Order 2 has been matched with BoxHelper: PK-SML-02
Order 3 has been matched with BoxHelper: PK-MED-01
Order 4 has been matched with BoxHelper: PK-LRG-03
Order 5 has been matched with BoxHelper: PK-SML-02
Order 6 has been matched with BoxHelper: PK-SML-02
Order 7 has been matched with BoxHelper: PK-MED-01
Order 8 has been matched with BoxHelper: PK-SML-02
Order 9 has been matched with BoxHelper: PK-SML-02
Order 10 has been matched with BoxHelper: PK-LRG-03
```
## Future Improvements
- Due to time constraints, minimal tests have been written for the code.
- Further abstraction/refactoring can be performed on the code to make it easier to read and split out business logic and presentation layer for readablity and testability.