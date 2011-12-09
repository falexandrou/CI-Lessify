CI-Lessify
==========

Loading the Library
-------------------
    $this->load->library('lessify');

Using the Library
-----------------
### Lessify a file, and return contents
    $this->lessify->file('css/main.less');

### Lessify a file and save the contents
    $this->lessify->file('css/main.less', 'css/main.css');

### Lessify a directory and return contents
    $this->lessify->directory('css/less');
    
### Lessify a directory and save the contents
    $this->lessify->directory('css/less', 'css/main.css');
    
Note: For the directory functions, files must have the .less extension.