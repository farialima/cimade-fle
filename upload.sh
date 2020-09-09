sftp  -P 21098 fariqxys@ftp.farialima.net:/home/fariqxys/cimade.farialima.net/ <<EOF
put index.html
put functions.php
put style.css
put resultat.html

#mkdir fle
put fle/index.php fle/index.php
#mkdir fle/resultats
rm  fle/resultats/index.html
put fle/resultats/index.php fle/resultats/index.php

#mkdir benevoles
put benevoles/index.php benevoles/index.php
#mkdir benevoles/resultats
rm  benevoles/resultats/index.html
put benevoles/resultats/index.php benevoles/resultats/index.php

#also getting the latest results...
get fle/rendezvous.csv fle/rendezvous.csv
get benevoles/rendezvous.csv benevoles/rendezvous.csv

EOF
