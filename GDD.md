# Rules

## Characters

A character (Player Character (PC) or Non Player Character (NPC)) has as attributes :
- a `strength`

  his `strength` defines the transportable weight : `maxWeight = 5 * strength` and a physical damage modifier : `physicalDamageMod = floor((strength - 10) / 2)`
  if the character is carrying more than he can, he suffers a penalty to his skills equal to `penalty = 5 * floor((weight - maxWeight) / 10)`
- a `constitution`

  his `constitution` defines his hit points : `hp = 2 * constitution`
- a `dexterity`

  his `dexterity` defines an attack modifier : `attackMod = floor((dexterity - 10) / 2)`
- an `intelligence` defines a magical damage modifier : `magicalDamageMod = floor((intelligence - 10) / 2)`
- a `wisdom` defines his mana points : `mana = 2 * wisdom`
- a `charisma` defines a social modifier to buy/sell items : `socialMod = 2 * floor((charisma - 10) / 2)`

  The social modifier gives a reduction on purchase and a better price on sale.

## Skills

List of skills :
- Weapon Type
  - `shortBlade`
  - `longBlade`
  - `hast`
  - `bow`
  - `crossbow`
  - `axe`
  - `mace`
  - `flail`
  - `hammer`
- `magic`
- `bargain`
- `repair`

**Maybe for the future**
- `craft`
- `enchant`

## Items

 Code           | Name            | Type       | Family     | Details                                                                                    | Droppable | Buyable | Script  
----------------|-----------------|------------|------------|--------------------------------------------------------------------------------------------|-----------|---------|--------
`shortsword`    | Short Sword     | `weapon`   | `shortBlad | `{"damage":[1,6],"critical":10,"physicalrange":[1,1],"distancerange":[-1,-1],"weight":1}`  | t         | t       | ""
`longsword`     | Long Sword      | `weapon`   | `longBlade | `{"damage":[1,8],"critical":10,"physicalrange":[1,1],"distancerange":[-1,-1],"weight":2}`  | t         | t       | ""
`shortbow`      | Short Bow       | `weapon`   | `bow`      | `{"damage":[1,6],"critical":5,"physicalrange":[-1,-1],"distancerange":[2,12],"weight":1}`  | t         | t       | ""
`longbow`       | Long Bow        | `weapon`   | `bow`      | `{"damage":[1,6],"critical":5,"physicalrange":[-1,-1],"distancerange":[2,20],"weight":1.5} | t         | t       | ""
`dagger`        | Dagger          | `weapon`   | `dagger`   | `{"damage":[1,4],"critical":10,"physicalrange":[0,1],"distancerange":[2,3],"weight":0.5}`  | t         | t       | ""
`lightflail`    | Light Flail     | `weapon`   | `flail`    | `{"damage":[1,8],"critical":5,"physicalrange":[1,1],"distancerange":[-1,-1],"weight":2}`   | t         | t       | ""
`lightMace`     | Light Mace      | `weapon`   | `mace`     | `{"damage":[1,6],"critical":5,"physicalrange":[1,1],"distancerange":[-1,-1],"weight":2}`   | t         | t       | ""
`lightHammer`   | Light Hammer    | `weapon`   | `hammer`   | `{"damage":[1,4],"critical":15,"physicalrange":[0,1],"distancerange":[-1,-1],"weight":2}`  | t         | t       | ""
`lightcrossbow` | Light Crossbow  | `weapon`   | `crossbow` | `{"damage":[1,8],"critical":10,"physicalrange":[-1,-1],"distancerange":[16,16],"weight":1. | t         | t       | ""
`boardingaxe`   | Boarding Axe    | `weapon`   | `axe`      | `{"damage":[1,6],"critical":15,"physicalrange":[1,1],"distancerange":[-1,-1],"weight":1.5} | t         | t       | ""
`halberd`       | Halberd         | `weapon`   | `hast`     | `{"damage":[1,10],"critical":15,"physicalrange":[1,2],"distancerange":[-1,-1],"weight":6}` | t         | t       | ""
