<?php
require_once 'config.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$search_results = [];
$search_term = '';

if (isset($_GET['search'])) {
    $search_term = $_GET['search'];
    $conn = getConnection();
    
    
    $sql = "SELECT * FROM products WHERE 
            name LIKE '%$search_term%' OR 
            category LIKE '%$search_term%' OR 
            description LIKE '%$search_term%'";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $search_results[] = $row;
        }
    }
    
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Search - Demo Site</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
        }
        
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .navbar h1 {
            font-size: 1.8em;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .user-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 500;
        }
        
        .role-badge {
            background: rgba(255, 255, 255, 0.3);
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.85em;
            text-transform: uppercase;
            font-weight: 600;
        }
        
        .btn-logout {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 10px 20px;
            border: 2px solid white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-logout:hover {
            background: white;
            color: #667eea;
        }
        
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        .search-section {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 40px;
        }
        
        .search-section h2 {
            color: #333;
            margin-bottom: 25px;
            font-size: 2em;
        }
        
        .search-form {
            display: flex;
            gap: 15px;
        }
        
        .search-input {
            flex: 1;
            padding: 15px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1.1em;
            transition: border-color 0.3s;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .btn-search {
            padding: 15px 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        
        .results-section h3 {
            color: #333;
            margin-bottom: 25px;
            font-size: 1.5em;
        }
        
        .results-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }
        
        .product-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        
        .product-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
        }
        
        .product-name {
            color: #333;
            font-size: 1.3em;
            font-weight: 600;
            flex: 1;
        }
        
        .product-price {
            color: #667eea;
            font-size: 1.5em;
            font-weight: 700;
        }
        
        .product-category {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 600;
            margin-bottom: 12px;
        }
        
        .product-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        
        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 2px solid #f0f0f0;
        }
        
        .stock-badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.9em;
            font-weight: 600;
        }
        
        .in-stock {
            background: #e8f5e9;
            color: #2e7d32;
        }
        
        .low-stock {
            background: #fff3e0;
            color: #e65100;
        }
        
        .no-results {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }
        
        .no-results h3 {
            color: #666;
            font-size: 1.5em;
            margin-bottom: 15px;
        }
        
        .no-results p {
            color: #999;
            font-size: 1.1em;
        }
        
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .search-form {
                flex-direction: column;
            }
            
            .results-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>🛍️ Product Catalog</h1>
        <div class="user-info">
            <div class="user-badge">
                Welcome, <?php echo $_SESSION['full_name']; ?>!
            </div>
            <div class="role-badge">
                <?php echo $_SESSION['role']; ?>
            </div>
            <a href="login.php?logout=1" class="btn-logout">Logout</a>
        </div>
    </nav>
    
    <div class="container">
        <div class="search-section">
            <h2>🔍 Search Products</h2>
            <form method="GET" class="search-form">
                <input 
                    type="text" 
                    name="search" 
                    class="search-input" 
                    placeholder="Search by name, category, or description..."
                    value="<?php echo htmlspecialchars($search_term); ?>"
                >
                <button type="submit" class="btn-search">Search</button>
            </form>
        </div>
        
        <?php if ($search_term): ?>
            <div class="results-section">
                <h3>Search Results for "<?php echo htmlspecialchars($search_term); ?>" (<?php echo count($search_results); ?> found)</h3>
                
                <?php if (count($search_results) > 0): ?>
                    <div class="results-grid">
                        <?php foreach ($search_results as $product): ?>
                            <div class="product-card">
                                <div class="product-category"><?php echo $product['category']; ?></div>
                                <div class="product-header">
                                    <div class="product-name"><?php echo $product['name']; ?></div>
                                    <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
                                </div>
                                <p class="product-description"><?php echo $product['description']; ?></p>
                                <div class="product-footer">
                                    <span class="stock-badge <?php echo $product['stock'] > 10 ? 'in-stock' : 'low-stock'; ?>">
                                        <?php echo $product['stock']; ?> in stock
                                    </span>
                                    <span style="color: #999; font-size: 0.85em;">ID: <?php echo $product['id']; ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-results">
                        <h3>No products found</h3>
                        <p>Try searching with different keywords</p>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
