<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/product-detail-pro/assets/public/css/app.css">

</head>
<body>
    <header>
        <div class="_flex _items-center _py-2 _w-full" style="height: 102px">
            <button  class="_my-auto _ml-3 _w-1/3 ">
                <div class="w-[20px] _m-1.5 _h-[1.5px] _bg-gray-700"></div>
                <div class="w-[20px] _m-1.5 _h-[1.5px] _bg-gray-700"></div>
                
            </button>
            <div class=" _w-1/3 _flex _justify-center">
                <p class="_text-xl _font-medium text-black-300">SUITSUPLLY</p>
            </div>
            <div class="_my-auto _flex _justify-end _items-center _w-1/3 _mr-3">
                <button class="_m-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" fill="gray" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                    </svg>
                </button>
                <button class="_m-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="20" fill="gray" class="bi bi-bookmark" viewBox="0 0 16 16">
                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                    </svg>
                </button>
                <button class="_m-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="gray" class="bi bi-bag" viewBox="0 0 16 16">
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                    </svg>
                </button>
            </div>
        </div>

    </header> 
    <?php
     $jsonFilePath = __DIR__ . '/jsons/Blazer-v1.json';
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