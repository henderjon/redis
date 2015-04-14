### Class: ScriptingMethodsTrait \[ `\Redis\Traits` \]

#### Method: `ScriptingMethodsTrait->evalLua($script, $keys [, $args = null])`

exeute a Lua script server side

for complete documentation: [redis.io/commands#scripting](http://redis.io/commands#scripting)

---

#### Method: `ScriptingMethodsTrait->evalsha($sha1, $keys [, $args = null])`

exeute a Lua script server side

for complete documentation: [redis.io/commands#scripting](http://redis.io/commands#scripting)

---

#### Method: `ScriptingMethodsTrait->scriptExists($scripts)`

Check existence of scripts in the script cache.

for complete documentation: [redis.io/commands#scripting](http://redis.io/commands#scripting)

---

#### Method: `ScriptingMethodsTrait->scriptFlush()`

Remove all the scripts from the script cache.

for complete documentation: [redis.io/commands#scripting](http://redis.io/commands#scripting)

---

#### Method: `ScriptingMethodsTrait->scriptKill()`

Kill the script currently in exeution.

for complete documentation: [redis.io/commands#scripting](http://redis.io/commands#scripting)

---

#### Method: `ScriptingMethodsTrait->scriptLoad($script)`

Load the specified Lua script into the script cache.

for complete documentation: [redis.io/commands#scripting](http://redis.io/commands#scripting)

