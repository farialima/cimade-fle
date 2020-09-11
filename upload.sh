sftp  -P 21098 fariqxys@ftp.farialima.net:/home/fariqxys/cimade.farialima.net/ <<EOF
put index.html
put functions.php
put style.css
put resultat.html

#mkdir fle
put fle/index.php fle/index.php
put fle/resultats.php fle/resultats.php

#mkdir benevoles
put benevoles/index.php benevoles/index.php
put benevoles/resultats.php benevoles/resultats.php

#also getting the latest results...
get fle/rendezvous.csv fle/rendezvous.csv
get benevoles/rendezvous.csv benevoles/rendezvous.csv

EOF
