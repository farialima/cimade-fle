sftp  -P 21098 fariqxys@ftp.farialima.net:/home/fariqxys/cimade.farialima.net/ <<EOF
put index.html
put functions.php
put style.css
#mkdir fle
put fle/index.php fle/index.php
#mkdir fle/resultats
put fle/resultats/index.html fle/resultats/index.html
#mkdir benevoles
put benevoles/index.php benevoles/index.php
#mkdir benevoles/resultats
put benevoles/resultats/index.html benevoles/resultats/index.html
EOF
