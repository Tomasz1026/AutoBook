# ALEKS KURWA TUTAJ PATRZ

Ogłaszam pierwszy plan 5 letni. Od dzisiaj wszystkie zmiany należy szczegółowo (ale po ludzku) opisać w Description podczas Commit to master. Na google keep udostępniłem ci wszystkie notatki jakie porobiłem co należy jeszcze dorobić (i gdzie). Jest też tam robota dla ciebie.<br>

Tomasz Tomasz 25.02.21:<br>
add.php:<br>
  JS:<br>
    - najeżdżanie na opcje w menu do dodawania tekstu, powoduje zmiane koloru<br>
    - najeżdżanie na logo profilu wyświetla menu<br>
    - kliknięcie save aktywuje ukryty przycisk submit dla formularza, który odpowiada za aktualizacje danych w rekordzie<br>
    - w bazie danych przebieg podajemy jako... liczba SZOK np. 123456 uważam, że taką liczbę mimo wszystko ciężej odczytać niż np. 123.456 zrobiłem tam fragment który zamienia dane wpisane w row właśnie na takie z kropką<br>
    - fragment odpowiadający za pokazanie menu profilu gdy najedzie się na profil (coż za zwrot akcji)<br>
    - funkcja była w kodzie od dawna ale dopiera teraz ją użyłem, chodzi o funkcję checkDesc. Funkcja skraca tekst z bazy danych do określonej w argumencie liczby znaków a potem dodaje wymowne 3 kropki<br>
    - wpisuje zawartość pierwszego row w miejsce podglądu<br>
  CSS:<br>
    - obsługa dwóch list (lista dodawanie tekstu i lista opcji profilu)<br>
    - drobne poprawki<br>
  HTML:<br>
    - usunięcie listy dodawania tekstu. Od teraz pobierana jest z bazy<br>
    - ukryty formularz, zmiana nazwy i typu inputa aby przechowywał id<br>
    - dodanie menu profilu z możliwością wylogowania<br>
    - dodanie name dla elementów formularza, które są przekazywane dla pliku update_services.php<br>
    - kliknięcie w logo autobook wraca do strony cartable.php<br>
  PHP:<br>
    - rekordy z tabeli service są wyszukiwane po id z tabeli car, nie VIN<br>
    - wyświetla listy dodawania tekstu, która została wcześniej pobrana z bazy danych<br>


cartable.php<br>
    JS:<br>
      - najeżdżanie na logo profilu wyświetla menu<br>
      - ukryty formularz, zmiana nazwy i typu inputa aby przechowywał id<br>
    CSS:<br>
      - drobne usprawnienia<br>
    HTML:<br>
      - dodanie menu profilu z możliwością wylogowania<br>
      - jednak zmieniłem plus.svg na Nowy ;P<br>
    PHP:<br>
      - przeróbki związane z pobieranie id rekordu do id .row<br>

  update_services.php<br>
    PHP:<br>
      - pozwala już na aktualizacje rekordu w bazie danych<br><br>
  Inne informacje:<br>
    - W innych plikach w folderze data_base_connections naniosłem kilka przeróbek aby pliki te mogły łączyć się z plikami poza data_base_connections xd<br>
    - Przerobiłem baze danych:<br>
        - wywaliłem VIN z tabeli service, zastąpiłem go car_id (wygodniejsze wyszukiwanie)<br>
        - dodałem trochę rekordów do testów (nie dodawaj więcej i nie zmieniaj już istniejących bo np. u mnie google zapamiętał dane do logowania więc jednym kliknięciem mogę się przełączać między różnymi fake kontami do testów polecam)<br>
    
