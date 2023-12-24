# 1. Day 2 - Beginner - Understanding data types and how to manipulate strings

## Day 2 goals

- Project: Tip calculator

## Python primitive data types

- `string`: string of characters
- subscript a string with `[]`: `str[0]`

```py
    print("Hello"[0]) #H
```

- `integer`: whole number, number without decimal places
- Seperate large number with `_`

```py
    a = 123
    b = 345
    print(a + b)

    large_number = 123_456_789
```

- `float`: floating point number, number with decimal places

```py
    pi = 3.14
    print(pi)
```

- `boolean`: logic with 2 values: `True` or `False`

```py
    a = True
    b = False 

    print(a)
    print(b)
```

## Type error, Type checking and Type conversion

- Type error: can only concatenate `str` to `str`

```py
    num_char = len(input("What is your name? "))
    print("Your name has " + num_char + " characters.")
```

- Perform type checking with `type` function

```py
    num_char = len(input("What is your name? "))
    print(type(num_char))
```

- Type conversion (type casting), change value from 1 type to another type

```py
    num_char = len(input("What is your name? "))
    new_num_char = str(num_char)
    print("Your name has " + new_num_char + " characters.")
```

- Type conversion, more examples

```py
    a = 123
    print(type(a))

    b = str(a)
    print(type(b))

    c = float(a)
    print(c)
```
