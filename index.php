<?php
$code = "";
$browser = get_browser(null, true);
session_start();
function usrAgent()
{
    $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
    $isMob = is_numeric(strpos($ua, "mobile"));
    if ($isMob == 1) {
        return true;
    } else {
        return false;
    }
}

function redirex($cd)
{
    if (strpos($cd, "hes") !== false) {
        if (codeCek($cd, 'hes')) {
            if (usrAgent()) {
                header("Location: HES-mobile.php");
            } else {
                header("Location: HES.php");
            }
        } else {
            // header("Location: system.php");
        }
    } elseif (strpos($cd, "hki") !== false) {
        if (codeCek($cd, 'hki')) {
            if (usrAgent()) {
                header("Location: HKI-mobile.php");
            } else {
                header("Location: HKI.php");
            }
        } else {
            header("Location: system.php");
        }
    } elseif (strpos($cd, "hpi") !== false) {
        if (codeCek($cd, 'hpi')) {
            if (usrAgent()) {
                header("Location: HPI-mobile.php");
            } else {
                header("Location: HPI.php");
            }
        } else {
            header("Location: system.php");
        }
    } elseif (strpos($cd, "mazawa") !== false) {
        if (codeCek($cd, 'mazawa')) {
            if (usrAgent()) {
                header("Location: MAZAWA-mobile.php");
            } else {
                header("Location: MAZAWA.php");
            }
        } else {
            header("Location: system.php");
        }
    } else {
        header("Location: system.php");
    }
}

function codeCek($code, $jur)
{
    $koneksi = mysqli_connect('103.157.96.102', 'khl', 's3mb4r4n999', 'fasya');
    $query = "SELECT * FROM `" . $jur . "` WHERE `code` ='" . $code . "'";
    print($query);
    $queryDB = mysqli_query($koneksi, $query);
    $check = mysqli_num_rows($queryDB);
    if ($check > 0) {
        $dt = array();
        while ($r = mysqli_fetch_assoc($queryDB)) {
            $dt[] = $r;
        }
        $_SESSION['name'] = $dt[0]['nama'];
        $_SESSION['codeId'] = $code;
        return true;
    } else {
        return false;
    }
}
if (isset($_GET['enter'])) {
    $code = $_GET['enter'];
    redirex($code);
} else {
    header("Location: system.php");
}
