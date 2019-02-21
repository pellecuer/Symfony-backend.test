# Test technique

## API de rendu de monnaie pour caisses automatiques

On veut écrire un service web qui indique comment rendre la monnaie sur une somme.
Notre service est interrogé par des automates (par exemple, des caisses automatiques) 
chaque fois qu’ils ont une somme à rendre, afin de connaître le nombre de billets et pièces à rendre.
Les sommes sont toujours entières, sans centimes.
Notre service doit indiquer la monnaie optimale (par exemple, 1 billet de 10 au lieu de 5 pièces de 2).

Chaque automate a un nom de modèle, qui définit ses caractéristiques et notamment les billets et pièces auxquels il a accès.
Les modèles supportés actuellement sont :

- le modèle `mk1`, qui n'a accès qu'aux pièces de 1 ;
- le modèle `mk2`, qui n’a accès qu’aux billets de 10, billets de 5 et pièces de 2.

On souhaite que notre application puisse être étendue facilement pour supporter d'autres modèles futurs.

Votre objectif: écrire une API qui puisse être interrogée par les automates.
Le test est calibré pour prendre environ 40 minutes.

1. Écrire deux classes `Mk1Calculator` et `Mk2Calculator` qui implémentent `AppBundle\Calculator\CalculatorInterface` 
   pour les modèles d'automates `mk1` et `mk2`.
   (25 minutes)
2. Écrire une classe `CalculatorRegistry` qui implémente `AppBundle\Registry\CalculatorRegistryInterface`.
   (10 minutes)
3. Écrire le controlleur en utilisant le service `CalculatorRegistry`. 
   (5 minutes)
4. Les tests doivent passer (executés avec `make unit`).
   Ajouter un test `Mk2CalculatorTest::testGetChangeHard`.
