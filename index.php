<?php
if(isset($_REQUEST['playlist'])) {
    $playlist = $_REQUEST['playlist'];
    $playlist_file = file("songs/$playlist");
   $files = array();
    foreach ($playlist_file as $song_name) {
        if(strpos($song_name, '#') !== false)
            continue;
        $song_name = str_replace("\r\n","", $song_name);;
        $files[] = "songs/$song_name";
    }
} else {
    $files = glob('songs/*.mp3');
    $playlists = glob('songs/*.txt');
}
include("music.html");
?>

<body>
<div id="header">

    <h1>190M Music Playlist Viewer</h1>
    <h2>Search Through Your Playlists and Music</h2>

</div>


<div id="listarea">
    <?php if(isset($playlist)) { ?>
        <li>
            <a href="index.php">Home page</a>
        </li>
    <?php } ?>
    <ul class="musiclist">
        <?php
        foreach ($files as $file) {
            $filename = basename($file);
            $size = filesize($file);
            ?>
            <li>
                <a href=" <?= $file ?>"><?= $filename ?></a> (<?php
                if ($size < 1024) {
                    print $size;
                    print " b";
                } else if ($size > 1023 & $size < 1048575) {
                    print round(($size / 1000), 2);
                    print "kb";
                } else {
                    print round(($size / 1048576), 2);
                    print " mb";
                }
                ?>)</a>
            </li>
        <?php } ?>
    </ul>

    <ul>
        <?php
        if (isset($playlists)) {
            foreach ($playlists as $playlist) {
                $filename = basename($playlist);?>
                <li class="playlistitem">
                    <a href="/?playlist=<?= $filename ?>"><?= $filename ?></a>
                </li>
            <?php }}?>
    </ul>
</div>
</body>

</html>