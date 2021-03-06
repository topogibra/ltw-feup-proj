<?php
    require_once "../database/session.php";
    require_once "../database/db_address.php";
    require_once "../database/db_user.php";

    if(!isset($_GET['placeID'])){
        header("Location: " . $_SERVER['HTTP_REFERER']);
        die();
    }

    if(!isPlace($_GET['placeID'])){
        header("Location: " . "home-page.php");
        die();
    }

    $placeDetails = getPlaceDetails($_GET['placeID']);
    $owner = getUserDetailsProfile($placeDetails['userID']);
    $address = getAddress($placeDetails['addressID']);

?>


<div id="property-page">

    <div id="property-header">
        <h1><?php echo $placeDetails['name'];?></h1>
        <img class="rating-house-pic" src="../images/FullHouse.png" alt="">
        <span id="property-rating">(4.1)</span>
    </div>

    <div id="property-body">
        <div id="property-pics">
            <img id="big-pic" src="../images/background-house.jpg" alt="" >

            <div id="small-pics">
                <img id="first-pic" src="" alt="" >
                <img id="second-pic" src="" alt="" >
                <img id="third-pic" src="" alt="" >
            </div>
        </div>

        <div id="property-info">
            <div id="property-label">
                <div id="owner-label">
                    <img id="owner-pic" src=<?php getUserImage($placeDetails['userID']);?> alt="">
                    <div id="owner-info">
                        <h3 id="owner-name"><?php echo $owner['firstName'] . " " . $owner['lastName'];?></h3>
                        <div id="owner-rating">
                            <img class="rating-house-pic" src="../images/FullHouse.png" alt="">
                            <span id="rating">(3.7)</span>
                        </div>
                    </div>
                </div>

                <div id="price-reservation">
                    <span id="property-price"><?php echo $placeDetails['price_by_night'];?>€ / day</span>
                    <div>
                        <?php require_once('../templates/reserve.php'); ?>
                    </div>
                    <!-- <button class="submit_button" id="login_button" onclick=<?php echo "location.href='../pages/reserve-page.php?placeID=" . $_GET['placeID'] . "'" ;?>>Reserve</button> -->

                </div>
            </div>

            <div class="input-line" id="property-info-rooms" >
                <div class='elem-property-rooms elem-property-bed' ><?php echo $placeDetails['number_bedrooms']; ?></div>
                <div class='elem-property-rooms elem-property-bath' ><?php echo $placeDetails['number_bathrooms']; ?></div>
                <div class='elem-property-rooms elem-property-guests' ><?php echo $placeDetails['max_guests']; ?></div>
            </div>

            <div id="property-description">
                <?php  echo $placeDetails['descrip']; ?>
            </div>
        </div>
    </div>

    
</div>
<footer id='black-footer'>