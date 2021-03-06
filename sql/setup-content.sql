SET NAMES utf8;

USE olen16;


DROP TABLE IF EXISTS anax_content;

CREATE TABLE anax_content (
id 					INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
path					CHAR(120) UNIQUE,
slug					CHAR(120) UNIQUE,

title					VARCHAR(120),
data					TEXT,
type					CHAR(20),
filter					VARCHAR(80) DEFAULT NULL,

published			DATETIME DEFAULT NULL,
created			TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated			DATETIME DEFAULT NULL,
deleted			DATETIME DEFAULT NULL,

KEY `index_type` (`type`),
KEY `index_published` (`published`),
KEY `index_deleted` (`deleted`)
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;


INSERT INTO anax_content (`path`, `slug`, `type`, `title`, `data`, `filter`) VALUES
    ("hem", null, "page", "Hem", "Detta är min hemsida. Den är skriven i [url=http://en.wikipedia.org/wiki/BBCode]bbcode[/url] vilket innebär att man kan formattera texten till [b]bold[/b] och [i]kursiv stil[/i] samt hantera länkar.\n\nDessutom finns ett filter 'nl2br' som lägger in <br>-element istället för \\n, det är smidigt, man kan skriva texten precis som man tänker sig att den skall visas, med radbrytningar.", "bbcode,nl2br"),
    ("om", null, "page", "Om", "Detta är en sida om mig och min webbplats. Den är skriven i [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig om HTML.\n\nRubrik nivå 2\n-------------\n\nDu skriver enkla styrtecken för att formattera texten som **fetstil** och *kursiv*. Det finns ett speciellt sätt att länka, skapa tabeller och så vidare.\n\n###Rubrik nivå 3\n\nNär man skriver i markdown så blir det läsbart även som textfil och det är lite av tanken med markdown.", "markdown"),
    ("blogpost-1", "valkommen-till-min-blogg", "post", "Välkommen till min blogg!", "Detta är en bloggpost.\n\nNär det finns länkar till andra webbplatser så kommer de länkarna att bli klickbara.\n\nhttp://dbwebb.se är ett exempel på en länk som blir klickbar.", "link,nl2br"),
    ("blogpost-2", "nu-har-sommaren-kommit", "post", "Nu har sommaren kommit", "Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost.", "nl2br"),
    ("blogpost-3", "nu-har-hosten-kommit", "post", "Nu har hösten kommit", "Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost", "nl2br");
    




INSERT INTO anax_content(title, path, slug, type, filter, published, updated, data) VALUES
	("Sidebar-länkar", null, "sidebar-links", "block", "markdown,link", "2017-04-22 16:40:00", "2017-04-22 16:41:00", "##Länkar

* https://google.com
* https://github.com
* http://stackoverflow.com
* https://dbwebb.se

Innehållet i den här sidebaren är ett block som finns i databasen."),
("En sida med text", "content-test-page", null, "page", "markdown", "2017-04-22 16:41:00", "2017-04-22 16:41:00", "Hej hopp, den här sidan innehåller text för att testa att detta fungerar. Här kommer jag köra med [Markdown](https://en.wikipedia.org/wiki/Markdown) för att formatera texten. Jag orkar bara skriva text för det här första stycket. Tack och hej.");