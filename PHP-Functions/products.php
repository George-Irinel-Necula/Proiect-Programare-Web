
<?php
class Product
{
    public int $id;
    public string $name;
    public string $photo;
    public float $rating;
    public float $price;

    public function __construct(int $id, string $name, string $photo, float $rating, float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->photo = $photo;
        $this->rating = $rating;
        $this->price = $price;
    }

    public function render()
    {
        echo '
        <div class="card card-xs sm:max-w-xs">
            <figure><img src="' . $this->photo . '" alt="' . htmlspecialchars($this->name) . '"></figure>
            <div class="card-body p-4">
                <h5 class="card-title min-h-12 line-clamp-2">' . htmlspecialchars($this->name) . '</h5>
                <div class="flex gap-1 py-2 items-center">
                    <span class="icon-[tabler--star-filled]"></span>
                    <span class="icon-[tabler--star-filled]"></span>
                    <span class="icon-[tabler--star-filled]"></span>
                    <span class="icon-[tabler--star-filled]"></span>
                    <span class="icon-[tabler--star-filled]"></span>
                    <h5 class="text-md">(' . $this->rating . ')</h5>
                </div>
                <h1 class="text-end text-xl text-white">' . number_format($this->price, 2) . ' Lei</h1>
                <div class="card-actions justify-end mt-2">
                    <button class="btn btn-primary btn-outline btn-sm sm:btn-md">Vezi detalii</button>
                    <form action="./PHP-Functions/add-to-cart.php" method="POST">
                        <input type="hidden" name="productId" value="' . $this->id . '">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn btn-secondary btn-sm sm:btn-md">Cumpara</button>
                    </form>
                </div>
            </div>
        </div>';
    }
}

function renderProductsFromDB()
{
    include "./PHP-Functions/db-connect.php";
    $sql = "SELECT id, product_name, photo, rating, price FROM products";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {

        $count = 0;

        while ($row = $result->fetch_assoc()) {

            if ($count % 4 === 0) {
                echo '<div class="w-full grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-6 justify-center mt-6">';
            }

            $product = new Product(
                (int)$row['id'],
                $row['product_name'],
                $row['photo'],
                (float)$row['rating'],
                (float)$row['price']
            );
            $product->render();

            if ($count % 4 === 3) {
                echo '</div>';
            }

            $count++;
        }
        if ($count % 4 !== 0) {
            echo '</div>';
        }

    } else {
        echo "<p>No products found.</p>";
    }
}

