# Rules

## Characters

A character (Player Character (PC) or Non Player Character (NPC)) has as attributes :
- a `strength`

  his `strength` defines the transportable weight : `maxWeight = 5 * strength` and a physical damage modifier : `physicalDamageMod = floor((strength - 10) / 2)`
  if the character is carrying more than he can, he suffers a penalty to his skills equal to `penalty = 5 * floor((weight - maxWeight) / 10)`
- a `constitution`

  his `constitution` defines his hit points : `hp = mulHP * constitution`
- a `dexterity`

  his `dexterity` defines an attack modifier : `attackMod = 5 * floor((dexterity - 10) / 2)`
- an `intelligence` defines a magical damage modifier : `magicalDamageMod = floor((intelligence - 10) / 2)`
- a `wisdom` defines his mana points : `mana = mulMana * wisdom`
- a `charisma` defines a social modifier to buy/sell items : `socialMod = 2 * floor((charisma - 10) / 2)`

  The social modifier gives a reduction (or increase) on purchase and a cheaper (or expensive) price on sale.

## Skills

### Skill Checks

Each character has one or more skills. He masters each skill at a certain percentage which can be modified according to the action.

The system rolls 1d100. If the result is under the percentage modified by the action and by the attribute modifier, the action is a success else it's a fail.
If the result is below one tenth of the modified percentage (max 10), it is a critical success.
If the result is above 90 plus one tenth of the modified percentage (max 99), it is a critical failure.

### Opposed Skill Checks

The character who performs the action is the active character, the reacting character, the inactive character.

In case of opposed skills checks, the winner is the character who makes the biggest margin.

The margin is calculated like this :
`margin = percentage - actionModifier - result`

In case of a critical success, the margin is multiplied by 2.
In case of a critical failure, the margin is divided by 2.

In case of equality, the winner is the active character.

### List of skills :
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
- `closeCombat`
- `dodge`
- `magic`
- `bargain`
- `repair`

**Maybe for the future**
- `craft`
- `enchant`


## Items

 Code           | Name            | Type       | Family          | Details                                                                                                        | Droppable | Buyable | Script  
----------------|-----------------|------------|-----------------|----------------------------------------------------------------------------------------------------------------|-----------|---------|--------
`shortsword`    | Short Sword     | `weapon`   | `shortBlade`    | `{"atk":0, "damage":[1,6], "critical":8, "physicalrange":[1,1],"distancerange":[-1,-1],"weight":1}`            | t         | t       | ""    
`longsword`     | Long Sword      | `weapon`   | `longBlade`     | `{"atk":-5,"damage":[1,8], "critical":8, "physicalrange":[1,1],"distancerange":[-1,-1],"weight":2}`            | t         | t       | ""    
`shortbow`      | Short Bow       | `weapon`   | `bow`           | `{"atk":0, "damage":[1,6], "critical":5, "physicalrange":[-1,-1],"distancerange":[2,12],"weight":1}`           | t         | t       | ""    
`longbow`       | Long Bow        | `weapon`   | `bow`           | `{"atk":-5,"damage":[1,6], "critical":5, "physicalrange":[-1,-1],"distancerange":[2,20],"weight":1.5}`         | t         | t       | ""    
`dagger`        | Dagger          | `weapon`   | `dagger`        | `{"atk":0, "damage":[1,4], "critical":8, "physicalrange":[0,1],"distancerange":[2,3],"weight":0.5}`            | t         | t       | ""    
`lightflail`    | Light Flail     | `weapon`   | `flail`         | `{"atk":-5,"damage":[1,8], "critical":5, "physicalrange":[1,1],"distancerange":[-1,-1],"weight":2}`            | t         | t       | ""    
`lightMace`     | Light Mace      | `weapon`   | `mace`          | `{"atk":0, "damage":[1,6], "critical":5, "physicalrange":[1,1],"distancerange":[-1,-1],"weight":2}`            | t         | t       | ""    
`lightHammer`   | Light Hammer    | `weapon`   | `hammer`        | `{"atk":0, "damage":[1,4], "critical":10,"physicalrange":[0,1],"distancerange":[-1,-1],"weight":2}`            | t         | t       | ""    
`lightcrossbow` | Light Crossbow  | `weapon`   | `crossbow`      | `{"atk":0, "damage":[1,8], "critical":8, "physicalrange":[-1,-1],"distancerange":[16,16],"weight":1.5}`        | t         | t       | ""    
`boardingaxe`   | Boarding Axe    | `weapon`   | `axe`           | `{"atk":0, "damage":[1,6], "critical":10,"physicalrange":[1,1],"distancerange":[-1,-1],"weight":1.5}`          | t         | t       | ""    
`halberd`       | Halberd         | `weapon`   | `hast`          | `{"atk":-5,"damage":[1,10],"critical":10,"physicalrange":[1,2],"distancerange":[-1,-1],"weight":6}`            | t         | t       | ""    

## Merchants

The merchants has a charisma, some gold pieces, some equipments and only one skill : bargain.
