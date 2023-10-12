<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/product-detail-pro/assets/public/css/app.css">

</head>
<body>
    <?php
     $jsonFilePath = __DIR__ . '/jsons/product-3.json';
     $jsonData = file_get_contents($jsonFilePath);
     $productData = json_decode($jsonData);
     ?>

    <div id="app">
        <product-detail-pro 
            :product-data="<?= htmlspecialchars(json_encode($productData->ProductData)) ?>"
            :Fabric="<?= htmlspecialchars(json_encode($productData->Data->Fabric)) ?>" 
            :Styles="<?= htmlspecialchars(json_encode($productData->Data->Styles)) ?>"
            :mapping="<?= htmlspecialchars(json_encode($productData->Mapping)) ?>"
            />
    </div>
    <script src="/product-detail-pro/assets/public/js/app.js"></script>
</body>
</html>