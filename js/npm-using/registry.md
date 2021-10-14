# npm registry

The JavaScript Package Registry

---

References

- [registry - npm docs](https://docs.npmjs.com/cli/v7/using-npm/registry)

## Description

**To resolve packages by name and version, npm talks to a registry website that implements the CommonJS Package Registry specification for reading package info.**

npm is configured to use the **npm public registry at [https://registry.npmjs.org](https://registry.npmjs.org) by default**.
_Use of the npm public registry is subject to terms of use available at [https://docs.npmjs.com/policies/terms](https://docs.npmjs.com/policies/terms)._

You can configure npm to use any compatible registry you like, and even run your own registry.
Use of someone else's registry may be governed by their terms of use.

……

The registry URL used is determined by the scope of the package
(see [scope](https://docs.npmjs.com/cli/v7/using-npm/scope)) .
If no scope is specified, the default registry is used, which is supplied by the registry config parameter. ……

……

## Does npm send any information about me back to the registry?

Yes.

……

## How can I prevent my package from being published in the official registry?

**Set `"private": true` in your `package.json` to prevent it from being published at all, or `"publishConfig":{"registry":"http://my-internal-registry.local"}` to force it to be published only to your internal/private registry.**

……

## Where can I find my own, & other's, published packages?

https://www.npmjs.com/
