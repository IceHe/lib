# Markdownlint `mdl`
#   https://github.com/markdownlint/markdownlint

# Usage
#   https://github.com/markdownlint/markdownlint/issues/67#issuecomment-75839369

# Rules of `mdl`
#   https://github.com/markdownlint/markdownlint/blob/master/docs/RULES.md

rule "MD001" # Header levels should only increment by one level at a time
# rule "MD002" # First header should be a top level header
rule "MD003" # Header style
# rule "MD004" # Unordered list style
# rule "MD005" # Inconsistent indentation for list items at the same level
rule "MD006" # Consider starting bulleted lists at the beginning of the line
# rule "MD007" , :indent => 4 # Unordered list indentation
rule "MD009" # Trailing spaces
rule "MD010" # Hard tabs
rule "MD011" # Reversed link syntax
rule "MD012" # Multiple consecutive blank lines
# rule "MD013" # Line length
# rule "MD014" # Dollar signs used before commands without showing output
rule "MD018" # No space after hash on atx style header
rule "MD019" # Multiple spaces after hash on atx style header
rule "MD020" # No space inside hashes on closed atx style header
rule "MD021" # Multiple spaces inside hashes on closed atx style header
rule "MD022" # Headers should be surrounded by blank lines
rule "MD023" # Headers must start at the beginning of the line
# rule "MD024" # Multiple headers with the same content
# rule "MD025" # Multiple top level headers in the same document
# rule "MD026" # Trailing punctuation in header
# rule "MD027" # Multiple spaces after blockquote symbol
rule "MD028" # Blank line inside blockquote
# rule "MD029" # Ordered list item prefix
# rule "MD030" # Spaces after list markers
# rule "MD031" # Fenced code blocks should be surrounded by blank lines
rule "MD032" # Lists should be surrounded by blank lines
# rule "MD033" # Inline HTML
# rule "MD034" # Bare URL used
rule "MD035" # Horizontal style
# rule "MD036" # Emphasis used instead of a header
rule "MD037" # Spaces inside emphasis markers
# rule "MD038" # Spaces inside code span elements
rule "MD039" # Spaces inside link text
# rule "MD046" # Code block style
