## Steps to run
* Install dependencies: ```docker run --rm --interactive --tty -v $(pwd):/app composer install```
* Run tests ```./vendor/bin/sail  artisan test --filter Tennis```




## Coding a game of tennis

The rules of a game of tennis can be confusing when described in natural language. Your
challenge is to take these rules and model them in code that is as simple as possible.
You should, through the use of unit tests, demonstrate code that can track the progress of
a single game between opponents, describe the current score and handle all possible
scores.
In case you are unfamiliar with the rules:
* A game is between two players and each player gains points as they win a shot
* For the purposes of this exercise, we are not concerned with how a player wins a
shot
* The points proceed as love (zero) , fifteen, thirty, forty, win
* If both players reach forty, the game is at “deuce”
* At deuce, a player must first gain “advantage” by winning the next point. They must
then also win the subsequent point to win the game. If their opponent wins the
subsequent point, the state returns to “deuce” rather than the opponent gaining an
additional point.
Submissions using either PHP or JavaScript are acceptable. A suitable testing framework
for your chosen language should be used.
Submit your code as you prefer – a GitHub repository or a zip file are both fine.


