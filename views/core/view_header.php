<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if(isset($primary_header)) : ?>
        <?php foreach($tmp_headers['css'] as $css) : ?>
            <?= $css ?>
        <?php endforeach; ?>
        <?php foreach($tmp_headers['js'] as $js) : ?>
            <?= $js ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <!-- React components -->
    <?php if(isset($tmp_components)) : ?>
        <?php foreach($tmp_components['js'] as $js) : ?>
            <?= $js ?>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <title>Document</title>
</head>
<body>
    <div id="re-nav"></div>
    <div id="re-main" ></div>