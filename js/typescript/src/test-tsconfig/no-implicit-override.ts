class Album {
  setup() {}
}

class MLAlbum extends Album {
  override setup() {}
}

class SharedAlbum extends Album {
  setup() {}
  // This member must have an 'override' modifier because it overrides a member in the base class 'Album'.
}
