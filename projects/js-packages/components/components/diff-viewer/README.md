# Unified Diff Viewer

Originally forked over from [Calypso](https://github.com/Automattic/wp-calypso/tree/b7a4a07/client/components/diff-viewer).

This component renders the output of a unified diff (`git diff` or `diff -u`) in a
visual format recognizable by someone who works with `diff` and comparing files.

## Usage

```jsx
import DiffViewer from 'components/diff-viewer';
export const CommitView = ( { commitHash, description, diff } ) => (
	<div>
		<div>
			<a href="https://wordpress.com">{ commitHash }</a>
		</div>
		<p>{ description }</p>
		<DiffViewer diff={ diff } />
	</div>
);
```

### Props

| Name     | Type     | Default | Description                    |
| -------- | -------- | ------- | ------------------------------ |
| `diff`\* | `string` | `''`    | Actual text output of the diff |

### Additional usage information

The diff output should be the full text produced by the diff command (including newlines).
Internally this component parses the output (the patch) and produces the data structure 
used to display files, hunks (sections of change in the files), and the actual lines of 
change and context.

```
diff --git a/circle.yml b/circle.yml
index 51455bdb14..bc0622d001 100644
--- a/circle.yml
+++ b/circle.yml
@@ -1,6 +1,6 @@
 machine:
   node:
-    version: 8.9.4
+    version: 8.11.0
 test:
   pre:
     - ? |
```
