# Deep Clone

References

- [Should we use clone or BeanUtils.copyProperties and why](https://stackoverflow.com/questions/15542504/should-we-use-clone-or-beanutils-copyproperties-and-why)
- [Can I create a DeepCopy of an Java Object/Entity with Mapstruct?](https://stackoverflow.com/questions/57378469/can-i-create-a-deepcopy-of-an-java-object-entity-with-mapstruct)
    - [mapstruct / mapstruct-examples / Cloner.java](https://github.com/mapstruct/mapstruct-examples/blob/master/mapstruct-clone/src/main/java/org/mapstruct/example/mapper/Cloner.java)
    - [MapStruct - 5.2. Mapping object references](https://mapstruct.org/documentation/dev/reference/html/#mapping-object-references)

## BeanUtils

```java
import lombok.SneakyThrows;
import lombok.experimental.UtilityClass;
import org.springframework.beans.BeanUtils;

/**
 * @author icehe.xyz
 * @since 2021/07/17
 */
@UtilityClass
public class ObjectUtil {

    @SneakyThrows
    public <T> T deepClone(T obj, Class<? extends T> objClazz) {
        T objClone = objClazz.newInstance();
        BeanUtils.copyProperties(obj, objClone);
        return objClone;
    }
}

```

## MapStruct

```java
/*
 * Copyright MapStruct Authors.
 *
 * Licensed under the Apache License version 2.0, available at http://www.apache.org/licenses/LICENSE-2.0
 */
package org.mapstruct.example.mapper;

import org.mapstruct.Mapper;
import org.mapstruct.control.DeepClone;
import org.mapstruct.example.dto.CustomerDto;
import org.mapstruct.factory.Mappers;

/**
 * @author Sjaak Derksen
 *
 * By defining all methods, we force MapStruct to generate new objects for each mapper in stead of
 * taking shortcuts by mapping an object directly.
 */
@Mapper(mappingControl = DeepClone.class)
public interface Cloner {

    Cloner MAPPER = Mappers.getMapper( Cloner.class );

    CustomerDto clone(CustomerDto customerDto);
}

```
