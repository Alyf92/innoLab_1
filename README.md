# Open-Source Linter
Im Bereich Continuous Integration bzw. Continuous Delivery gibt es viele Parameter, um die Codequalität zu verbessern. Dies kann sowohl mit Unit Tests, also auch Code-Style oder Code Patterns bzw. best practice Ansatzen überprüft werden. In diesem InnoLab wäre es Ziel hinsichtlich PHP eine CI/CD Pipeline zu erzeugen, die es Studierenden ermöglicht auf der eigenen Maschine den Code auf Safety & Security inklusive weiteren Aspekten (einfach) zu überprüfen. Dieser Prozess soll zu einer verbesserten Codequalität  führen und als Resultat eine Bewertung in Form eines HTML Exports liefern. 

*Aktuelle Phase: Dokumentation der Vergleiche von flogende Linter*

## PHP Parallel Lint

[PHP Parallel Lint](https://github.com/php-parallel-lint/PHP-Parallel-Lint) prüft parallel die Syntax von PHP-Dateien. Es kann in Klartext, farbigem Text, JSON und Checksyntax-Formaten ausgegeben werden. Zusätzlich kann die „blame“ verwendet werden, um Commits anzuzeigen, die den Bruch verursacht haben.  
README.md: `--blame 	Try to show git blame for row with error.`
Das Ausführen paralleler Aufgaben in PHP wurde von Nette Framework-Tests inspiriert. Die Anwendung wird offiziell für die Verwendung mit PHP 5.3 bis 8.0 unterstützt.

## PHP_CodeSniffer

[PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) ist ein Set von zwei PHP-Skripten, das wichtigste phpcs-Skript, das PHP-, JavaScript- und CSS-Dateien tokenisiert, um Verstöße gegen einen definierten Codierungsstandard zu erkennen, und ein zweites phpcbf-Skript, um Verstöße gegen Codierungsstandards automatisch zu korrigieren. PHP_CodeSniffer ist ein Entwicklungstool, das sicherstellt, dass der Code sauber und konsistent bleibt. Der Output kann mit einem kurzen Befehl in eine Textdatei eingefügt werden.
PHP_CodeSniffer erfordert PHP-Version 5.4.0 oder höher, obwohl einzelne Sniffs zusätzliche Anforderungen wie externe Anwendungen und Skripte haben können.

## PHPMD

[PHPMD](https://github.com/phpmd/phpmd) ist ein Spin-off-Projekt von PHP Depend und zielt darauf ab, ein PHP-Äquivalent des bekannten Java-Tools PMD zu sein. PHPMD kann als benutzerfreundliche Frontend-Anwendung für den von PHP Depend gemessenen Rohdatenstrom angesehen werden.
Im Moment kommt PHPMD mit den folgenden Renderern:  
•	xml, which formats the report as XML.  
•	text, simple textual format.  
•	html, single HTML file with possible problems.  
•	json, formats JSON report.  
•	ansi, a command line friendly format.  
•	github, a format that GitHub Actions understands.  
•	sarif, the Static Analysis Results Interchange Format.  
•	checkstyle, language and tool agnostic XML format.  
 
## PHPLint
[PHPLint](https://github.com/overtrue/phplint)
PHPLint ist ein Tool, das das Linten von PHP-Dateien beschleunigen kann, indem mehrere Lint-Prozesse gleichzeitig ausgeführt werden. Das Projekt wurde von JetBrains unterstützt. Für die Installation ist PHP 8.0 oder aktueller und Composer 2.0 oder aktueller.  
Falls man jedoch PHP [7.0](https://github.com/overtrue/phplint/tree/7.4) benutzt, gibt es hierfür eine eigene Github Branch vom Entwickler.  
Nutzung:  
  `phplint [options] [--] [<path>]...`  
Es sind einige Optionen möglich die sehr nützlich sein können wie das Formatieren in eine JSON oder JUnit XML Datei, Warnungen ebenso im Output anzuzeigen, Anzahl der parallel auszuführenden Jobs (Standard: 5), interaktive Fragen zu ignorieren und einiges mehr.
Alle Optionen sind unter dem Punkt CLI im Readme auf Github gelistet. 

## PHP Coding Standards Fixer

[PHP Coding Standards Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) (PHP CS Fixer) korrigiert den Code so, dass er den Standards entspricht. Egal ob wir den PHP-Codierungsstandards wie in PSR-1, PSR-2 usw. folgen oder andere Community-gesteuerte wie die von Symfony. Wir können auch den Stil unseres (Teams) durch die Konfiguration definieren.  
Es kann unsern Code modernisieren (z. B. die pow-Funktion in den \*\*Operator in PHP 5.6) umwandeln und (micro) optimieren.
Wenn man bereits einen Linter verwendet, um Probleme mit Codierungsstandards im Code zu identifizieren, weiss man, dass es mühsam ist, sie von Hand zu beheben, insbesondere bei großen Projekten. Dieses Tool erkennt sie nicht nur, sondern behebt sie auch für uns.
