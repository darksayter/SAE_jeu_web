<?php
    include '../../header_e.php';
?>
<head>
<link rel="stylesheet" type="text/css" href="../../../assets/CSS/style.css" />
<style>
#image-grid {
    position: relative;
    width: 900px;
    height: 600px;
    background-size: cover;
    display: grid;
    grid-template-columns: repeat(10, 1fr);
    grid-template-rows: repeat(10, 1fr);
}

#image-grid div {
    cursor: pointer;
    transition: transform 0.3s ease, z-index 0.3s ease;
}

#image-grid div.enlarged {
    transform: scale(10);
    z-index: 10;
}
</style>
</head>

<body>

  <div id="image-grid" class="image-grid"></div>
  <div id = screen>
    <script src="script.js"></script>
  </div>

<?php
    include '../../footer_e.php';
?>
