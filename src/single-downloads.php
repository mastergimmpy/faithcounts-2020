<?php 
// all this does is update the number of times this has been downloaded (view count) and
// redirects the user to the actual file.
increment_view_count();
header('Location: ' . get_field('file'));
die();