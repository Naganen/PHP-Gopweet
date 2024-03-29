<!DOCTYPE html>
<html lang="tr">

<head>
    <?php
    include('function.php');

    $userid = $_COOKIE['login'];
    $logined = CheckUser($_COOKIE['login'], $con);

    if ($userid == null) {
        Redirect("index.php");
    }

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/2a63621396.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="shortcut icon" href="favicon.ico" />
    <title>Gopweet Sosyal Paylaşım Sitesii</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/journal/bootstrap.min.css">
    <!-- 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</head>


<body data-bs-theme="dark" class="overflow-x-hidden" id="body">
    <style>
        .btn-danger {
            background-color: #E95793 !important;
        }
    </style>
    <script>
        document.getElementById("body").style.display = "none";

        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("body").style.display = "block";
        });
    </script>
    <div class="d-flex border-top border-secondary fixed-bottom bg-dark d-md-none p-3 pb-4" id="bottomMenu">
        <button class="btn flex-fill" type="button" data-bs-toggle="dropdown" aria-expanded="false"><img
                onerror='this.onerror=null; this.src="pp.jpg";' class="rounded-circle" width="26px"
                src="<?php echo $logined['profilepic']; ?>" />
        </button>
        <ul class="dropdown-menu dropdown-menu-end col-2">
            <li><a class='dropdown-item' href="@<?php echo $logined['username']; ?>"><i class="fas fa-user"></i>
                    Profiline Git</a></li>
            <li><a class='dropdown-item' href='tool_logout.php'><i class="fas fa-sign-out-alt"></i> Çıkış
                    Yap</a></li>
        </ul>
        <a class="flex-fill btn btn-dark" href="following.php" rel="noopener noreferrer"><i
                class="fa-solid fa-user-group"></i></a>
        <a class="flex-fill btn" href="home.php" rel="noopener noreferrer"><i class="fa-solid fa-house"></i></a>
        <a class="flex-fill btn btn-dark disabled" href="home.php" rel="noopener noreferrer"><i
                class="fa-solid fa-magnifying-glass"></i></a>
        <a class="flex-fill btn btn-dark disabled" href="home.php" rel="noopener noreferrer"><i
                class="fa-solid fa-message"></i></a>

    </div>

    <div class="modal fade" id="popularHashtags" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Popüler Etiketler</h1>
                </div>
                <div class="modal-body">
                    <?php
                    $tags_sql = "SELECT * FROM content";
                    $tags_query = mysqli_query($con, $tags_sql);
                    while ($tags = mysqli_fetch_array($tags_query, MYSQLI_ASSOC)) {
                        $hashtags[$tags["id"]] = $tags["hashtag"];
                    }
                    $hashtags = array_filter(explode(",", implode(",", $hashtags)));
                    $counts = array_count_values($hashtags);
                    arsort($counts);
                    for ($i = 0; $i < 5; $i++) {
                        if (array_keys($counts)[$i] != null) {
                            echo "<a class='text-decoration-none btn btn-dark' href='hashtag.php?hashtag=" . array_keys($counts)[$i] . "'>#" . array_keys($counts)[$i] . " - " . $counts[array_keys($counts)[$i]] . "</a><br>";
                        }
                    }
                    ?>
                    <br>
                    <button type="button" class="btn btn-light float-end" data-bs-dismiss="modal">Kapat</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="addImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Resim ve ya Fotoğraf Ekle</h1>
                </div>
                <div class="modal-body">
                    <input class='form-control' type='text' name='imgurl' id="imgurl"
                        placeholder='Resim ve ya Fotoğraf Linki'><br>
                    <br>
                    <button type="button" class="btn btn-dark float-end" data-bs-dismiss="modal">İptal</button>
                    <button onclick="imgRemove()" type="button" class="btn btn-dark float-end"
                        data-bs-dismiss="modal">Kaldır</button>
                    <button onclick="imgAdd()" type="button" class="btn btn-light float-end"
                        data-bs-dismiss="modal">Ekle</button>
                </div>

            </div>
        </div>
    </div>


    <div class="row align-top g-2 p-3" style="min-height: 100vh;">
        <div class="col text-start justify-content-start align-items-start d-none d-md-block">
            <div class="position-fixed top-0 start-0 mt-3 ms-3 d-grid col-2">
                <h1 class="logo">Gopweet</h1>
                <a class="text-decoration-none btn btn-dark text-start" style="font-size: 18px;" href="home.php"
                    rel="noopener noreferrer"><i class="fa-solid fa-house"></i> Ana Sayfa</a>
                <a class="text-decoration-none btn btn-dark text-start" style="font-size: 18px;" href="following.php"
                    rel="noopener noreferrer"><i class="fa-solid fa-user-group"></i> Takip
                    Edilenler</a>
                <a class="text-decoration-none btn btn-dark text-start disabled" style="font-size: 18px;"
                    href="home.php" rel="noopener noreferrer"><i class="fa-solid fa-magnifying-glass"></i> Ara</a>
                <a class="text-decoration-none btn btn-dark text-start disabled" style="font-size: 18px;"
                    href="home.php" rel="noopener noreferrer"><i class="fa-solid fa-message"></i> Mesajlar</a>
            </div>
            <button class="btn btn-dark position-fixed start-0 bottom-0 mb-3 ms-3 col-2 text-start"
                style="font-size: 22px;" type="button" data-bs-toggle="dropdown" aria-expanded="false"><img
                    onerror='this.onerror=null; this.src="pp.jpg";' class="rounded-circle" width="32px"
                    src="<?php echo $logined['profilepic']; ?>" /> <span style="font-size: 20px; height: 32px;">
                    <?php echo "@" . $logined['username']; ?>
                </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end col-2">
                <li><a class='dropdown-item' href="@<?php echo $logined['username']; ?>"><i class="fas fa-user"></i>
                        Profiline Git</a></li>
                <li><a class='dropdown-item' href='tool_logout.php'><i class="fas fa-sign-out-alt"></i> Çıkış
                        Yap</a></li>
            </ul>
        </div>
        <div class="col text-center justify-content-center align-items-center" style="padding-bottom: 100px;">
            <h1 class="d-block d-md-none">Gopweet</h1>
            <a class="d-block d-md-none btn position-absolute top-0 end-0 m-3" data-bs-toggle="modal"
                data-bs-target="#popularHashtags"><i class="fas fa-hashtag"></i></a>
            <form action='tool_publish.php' method='post' class='publish'>
                <div class="mb-3">
                    <img class="float-center w-50 rounded mb-2" id="publishimg" src="" onclick="imgRemove()"
                        onerror="this.hide">
                    <textarea class="form-control" placeholder="Ne düşünüyorsun?" name="post" id="post"
                        rows="4"></textarea>
                </div>
                <a title="Resim ve ya Fotoğraf Ekle" data-bs-toggle="modal" data-bs-target="#addImage"
                    class='btn btn-dark float-start'><i class="fa-regular fa-file-image"></i>
                </a>
                <input class="d-none" name="img" id="img">
                <input class="d-none" name="related" id="related" value="0">
                <button type="submit" class="btn float-end btn-light">Paylaş</button>
            </form>
            <br>
            <br>
            <br>

            <p style='background-color: #E95793; font-weight: 600;' class='d-none card mt-3 p-3'></p>
            <button class="btn btn-dark dropdown-toggle float-end" type="button" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fa-solid fa-arrow-down-wide-short"></i></button>
            <ul class="dropdown-menu dropdown-menu-end">
                <?php
                $sort = $_GET['sort'];
                if ($sort == 'old') {
                    echo "<li><a class='dropdown-item' href='home.php'>En Yeni</a></li>
                                    <a class='dropdown-item text-dark bg-light' href='home.php?sort=old'>En Eski</a></li>
                                    <a class='dropdown-item' href='home.php?sort=best'>En Beğenilen</a></li>";
                    $sortby = 'id ASC';
                } elseif ($sort == 'best') {
                    echo "<li><a class='dropdown-item' href='home.php'>En Yeni</a></li>
                                    <a class='dropdown-item' href='home.php?sort=old'>En Eski</a></li>
                                    <a class='dropdown-item text-dark bg-light' href='home.php?sort=best'>En Beğenilen</a></li>";
                    $sortby = 'likes DESC';
                } else {
                    echo "<li><a class='dropdown-item text-dark bg-light' href='home.php'>En Yeni</a></li>
                                    <a class='dropdown-item' href='home.php?sort=old'>En Eski</a></li>
                                    <a class='dropdown-item' href='home.php?sort=best'>En Beğenilen</a></li>";
                    $sortby = 'id DESC';
                }
                ?>
            </ul>
            <br>
            <?php
            $getposts = "SELECT * FROM `content` ORDER BY $sortby";
            $posts = mysqli_query($con, $getposts);
            echo "<div id='postArea'>";
            while ($post = mysqli_fetch_array($posts, MYSQLI_ASSOC)) {
                PostHTML($post, $logined, $userid);
            }
            echo "</div>";
            ?>
            <br>
            <br>
        </div>
        <div class="col text-end justify-content-end align-items-end d-none d-md-block">
            <p><span class="btn btn-dark disabled">Popüler Etiketler</span><br>
                <?php
                for ($i = 0; $i < 5; $i++) {
                    if (array_keys($counts)[$i] != null) {
                        echo "<a class='text-decoration-none btn btn-dark' href='hashtag.php?hashtag=" . array_keys($counts)[$i] . "'>#" . array_keys($counts)[$i] . " - " . $counts[array_keys($counts)[$i]] . "</a><br>";
                    }
                }
                ?>
            </p>
        </div>

        <script src="scripts.js?v=4_2"></script>
</body>

</html>