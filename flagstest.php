<!-- A form with checkboxes for different kind of permissions -->
<form action="flagstest.php" method="post">
    <fieldset>
        <legend>Flags</legend>
        <input type="checkbox" name="read" value="1" />
        <label for="read">Read</label>
        <br />
        <input type="checkbox" name="write" value="2" />
        <label for="write">Write</label>
        <br />
        <input type="checkbox" name="update" value="4" />
        <label for="update">Update</label>
        <br />
        <input type="checkbox" name="delete" value="8" />
        <label for="delete">Delete</label>
        <br />
        <input type="checkbox" name="admin" value="2147483647" />
        <label for="admin">Admin</label>
        <br />
        <input type="submit" name="perms" value="Submit" />
    </fieldset>
</form>
<?php
// Check if the form has been submitted
if (!isset($_POST['perms'])) return;

// Get the permissions
$perms = 0;
if (isset($_POST['read'])) $perms += $_POST['read'];
if (isset($_POST['write'])) $perms += $_POST['write'];
if (isset($_POST['update'])) $perms += $_POST['update'];
if (isset($_POST['delete'])) $perms += $_POST['delete'];
if (isset($_POST['admin'])) $perms += $_POST['admin'];

// Print the permissions
echo "<h3>Permissions</h3>";
echo "<p>";
if ($perms == 0) echo "User";
if ($perms & 1) echo " Read";
if ($perms & 2) echo " Write";
if ($perms & 4) echo " Update";
if ($perms & 8) echo " Delete";
echo "</p>";
// Print the permissions in binary with leading zeros
echo "<p>";
echo str_pad(decbin($perms), 8, "0", STR_PAD_LEFT);
echo "</p>";
// print the permissions in octal
echo "<p>";
echo decoct($perms);
echo "</p>";