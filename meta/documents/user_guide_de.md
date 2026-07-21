# Ceres Coconut – Ein Coconut Theme für Ceres 3

**Ceres Coconut** ist ein einfaches Theme-Plugin, welches noch keine Design-Anpassungen für Ceres 3 enthält. Mithilfe des Themes kann eigenes CSS in Ceres angezeigt werden. Zudem können Templates von Ceres durch eigene Templates überschrieben werden.

## Eigenes CSS anzeigen

Nach **Installation** und **Bereitstellung** des Plugins geben Sie Ihr eigenes CSS in der Plugin-Detailansicht ein.

##### Eigenes CSS eingeben:

1. Öffnen Sie das Menü **Plugins » Plugin-Übersicht**.<br /> → Die Plugin-Übersicht wird geöffnet.
2. Klicken Sie auf **CeresCoconut**.<br /> → Das Plugin wird geöffnet.
3. Klicken Sie im Verzeichnisbaum auf **Dateien » resources » css » main.css**.
4. Geben Sie Ihre CSS-Änderungen ein.
5. **Speichern** Sie die Einstellungen.<br /> → Die CSS-Änderungen werden nach der nächsten Plugin-Bereitstellung verfügbar.

##### Eigenes CSS aktivieren:

1. Öffnen Sie das Menü **CMS » Container-Verknüpfungen**.
2. Wählen Sie den Bereich **Stylesheet (CeresCoconut)**.
3. Aktivieren Sie den Container **Template: Style**.
4. **Speichern** Sie die Einstellungen.<br /> → Das CSS wird im Webshop angezeigt.

## Eigene Templates anzeigen

**CeresCoconut** ermöglicht es Ihnen die Templates von **Ceres** mit Ihren eigenen Inhalten zu überschreiben. Geben Sie dafür Ihren Template-Code im Template ein und überschreiben Sie das Template. Dies wird nachfolgend am Beispiel der Startseite erklärt. Richten Sie andere Templates analog ein.

##### Code für eigene Startseite eingeben:

1. Öffnen Sie das Menü **Plugins » Plugin-Übersicht**.<br /> → Die Plugin-Übersicht wird geöffnet.
2. Klicken Sie auf **CeresCoconut**.<br /> → Das Plugin wird geöffnet.
3. Klicken Sie im Verzeichnisbaum auf **Dateien » resources » views » Homepage » Homepage.twig**.
4. Geben Sie den Code für die Startseite ein.
5. **Speichern** Sie die Einstellungen.<br /> → Die Template-Anpassungen werden nach der nächsten **Plugin-Bereitstellung** verfügbar.

##### Eigene Startseite aktivieren:

1. Öffnen Sie das Menü **Plugins » Plugin-Übersicht**.<br /> → Die Plugin-Übersicht wird geöffnet.
2. Klicken Sie auf **CeresCoconut**.<br /> → Das Plugin wird geöffnet.
3. Klicken Sie im Verzeichnisbaum auf **Konfiguration » Templates**.
4. Aktivieren Sie **Startseite** unter **Partials und Templates überschreiben**.
5. **Speichern** Sie die Einstellungen.<br /> → Die Startseite wird angezeigt.

## Eigene Datenfelder verwenden

**CeresCoconut** ermöglicht es Ihnen die Datenfelder von Ceres zu überschreiben und die vorhandenen Daten um eigene Daten auf verschiedenen Seiten wie Warenkorb, Kategorieansicht, Artikelansicht, etc. zu erweitern. Dies wird nachfolgend am Beispiel der Artikelseite erklärt. Richten Sie andere Seiten analog ein.

##### Datenfelder der Artikelseite anpassen:

1. Öffnen Sie das Menü **Plugins » Plugin-Übersicht**.<br /> → Die Plugin-Übersicht wird geöffnet.
2. Klicken Sie auf **CeresCoconut**.<br /> → Das Plugin wird geöffnet.
3. Klicken Sie im Verzeichnisbaum auf **Dateien » resources » views » ResultFields » SingleItem.fields.json**.
4. Fügen Sie weitere Datenfelder hinzu.
5. **Speichern** Sie die Einstellungen.<br /> → Die Anpassungen werden nach der nächsten **Plugin-Bereitstellung** verfügbar.

##### Eigene Datenfelder aktivieren:

1. Öffnen Sie das Menü **Plugins » Plugin-Übersicht**.<br /> → Die Plugin-Übersicht wird geöffnet.
2. Klicken Sie auf **CeresCoconut**.<br /> → Das Plugin wird geöffnet.
3. Klicken Sie im Verzeichnisbaum auf **Konfiguration » Datenfelder**.
4. Aktivieren Sie **Artikeldaten der Artikelansicht** unter **Datenfelder überschreiben**.
5. **Speichern** Sie die Einstellungen.<br /> → Ihre eigenen Datenfelder werden für die Artikelansicht aktiviert.

## PlentyONE-Artikel in CleverReach verwenden

Die CleverReach-MyContent-Schnittstelle stellt sichtbare und aktive Artikel aus dem Shop für den CleverReach-Newsletter-Editor bereit. Übertragen werden Artikelname, Kurzbeschreibung, Produktbild, Verkaufspreis, Artikelnummer, Verfügbarkeit und Shoplink.

##### Schnittstelle in PlentyONE einrichten:

1. Installieren Sie Version 1.1.0 dieses Plugins im Plugin-Set des Shops.
2. Öffnen Sie **Plugins » Plugin-Übersicht**.
3. Öffnen Sie das Plugin **CeresCoconut**.
4. Öffnen Sie **Konfiguration » CleverReach-Produktsuche**.
5. Tragen Sie ein langes, zufälliges **Schnittstellen-Kennwort** ein.
6. Prüfen Sie die Shop-URL `https://www.amikon-shop.de`.
7. Speichern Sie die Konfiguration und stellen Sie das Plugin-Set bereit.

Die Produktquellen-URL lautet anschließend:

`https://www.amikon-shop.de/rest/cleverreach/products?password=IHR_KENNWORT`

##### Schnittstelle prüfen:

Senden Sie einen POST-Aufruf mit `get=filter` an die Produktquellen-URL. Die Antwort muss die Suchfelder **Sprache** und **Artikel** als JSON enthalten. Ein POST-Aufruf mit `get=search`, `language=de` und `product=SLM` muss passende Produkte liefern.

##### Produktquelle in CleverReach einrichten:

1. Hinterlegen Sie die oben genannte URL als **MyContent-Produktquellen-URL** in CleverReach. Falls das Feld in Ihrem Konto nicht angezeigt wird, lassen Sie die eigene MyContent-Produktquelle durch den CleverReach-Support aktivieren.
2. Erstellen oder öffnen Sie einen Newsletter.
3. Fügen Sie ein Produkt-Layout beziehungsweise dynamisches Element ein.
4. Öffnen Sie **Dynamischen Inhalt einfügen** und wählen Sie die neue Produktquelle.
5. Wählen Sie die Sprache und suchen Sie nach Artikelname, Artikel-ID oder Variantennummer.
6. Wählen Sie einen Treffer aus und übernehmen Sie ihn in den Newsletter.

Das Schnittstellen-Kennwort darf nicht veröffentlicht oder in normalen Shopseiten ausgegeben werden. Ändern Sie es in PlentyONE und in CleverReach gleichzeitig, falls es bekannt geworden ist.

## Lizenz

Das gesamte Projekt unterliegt der GNU AFFERO GENERAL PUBLIC LICENSE – weitere Informationen finden Sie in der [LICENSE](https://github.com/plentymarkets/plugin-ceres-Coconut/blob/master/LICENSE).
