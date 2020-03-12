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

 Code          | Name         | Type       | Family       | Details 
---------------|--------------|------------|--------------|---------------------------------------------
 `shortsword`  | Short Sword  | `weapon`   | `shortBlade` | `{"damage":[1,6,10],"range":0,"weight":1}`
 `longsword`   | Long Sword   | `weapon`   | `longBlade`  | `{"damage":[1,8,10],"range":0,"weight":2}`
 `shortbow`    | Short Bow    | `weapon`   | `bow`        | `{"damage":[1,6,5],"range":5,"weight":1}`
 `longbow`     | Long Bow     | `weapon`   | `bow`        | `{"damage":[1,6,5],"range":8,"weight":1.5}`
 `dagger`      | Dagger       | `weapon`   | `dagger`     | `{"damage":[1,4,10],"range":0,"weight":0.5}`
 `lightflail`  | Light Flail  | `weapon`   | `flail`      | `{"damage":[1,8,5],"range":0,"weight":2}`
 `lightMace`   | Light Mace   | `weapon`   | `mace`       | `{"damage":[1,6,5],"range":0,"weight":2}`
 `lightHammer` | Light Hammer | `weapon`   | `hammer`     | `{"damage":[1,4,15],"range":0,"weight":2}`
 `` |  | `weapon`   | `` | `{"damage":[1,6,5],"range":0,"weight":1}`




