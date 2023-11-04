<!DOCTYPE html>
<html>

<head>
    <title>Shopping Cart</title>
</head>

<body>
    <h1>Your Shopping Cart</h1>

    <table>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
        <?php
         
        session_start();
        
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart']->getItems() as $productName => $quantity) {
                $product = findProductByName($productName); 
                if ($product) {
                    echo "<tr>";
                    echo "<td>{$product->getName()}</td>";
                    echo "<td>{$product->getPrice()}</td>";
                    echo "<td>$quantity</td>";
                    echo "</tr>";
                }
            }
            
            echo "<tr>";
            echo "<td colspan='2'>Total Price</td>";
            echo "<td>{$_SESSION['cart']->getTotalPrice()}</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <a href="index.html">Back to Store</a>
</body>

</html>