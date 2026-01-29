<?php
if (!file_exists('temp')) {
    if (mkdir('temp', 0777, true)) {
        echo "Directory 'temp' created successfully.";
    } else {
        echo "Failed to create directory 'temp'.";
    }
} else {
    echo "Directory 'temp' already exists.";
}
