# Baizy Custom Blocks

TypeScript（Vite ビルド）製のカスタムブロックをブロックエディターに追加する WordPress プラグインです。
baizy テーマから独立させたもので、テーマに依存せず単体で動作します。

## 必要環境

- WordPress 6.0+
- PHP 8.0+
- Node.js 18+ / pnpm（ブロックを開発・ビルドする場合のみ）

## インストール

1. このディレクトリを `wp-content/plugins/baizy-custom-blocks/` に配置
2. 管理画面 →「プラグイン」→「Baizy Custom Blocks」を有効化

ビルド済みの `build/custom-blocks.js` が同梱されているため、利用するだけなら Node.js は不要です。

## 収録ブロック

カテゴリー「カスタムブロック」（`baizy-blocks`）に登録されます。

| ブロック | 名前 | ソース |
| --- | --- | --- |
| サンプルブロック | `my-blocks/sample-block` | `src/blocks/sample-block/` |
| 別のサンプルブロック | `my-blocks/another-block` | `src/blocks/another-block/` |
| タイトルブロック | `my-blocks/ttl-block` | `src/blocks/ttl-block/` |
| Q&A ブロック | `my-blocks/qa-block` | `src/blocks/qa-block/` |
| ボックスフレックス | `my-blocks/box-flex` | `src/blocks/box-flex/`（デフォルト無効） |

有効にするブロックは `src/index.tsx` の import で切り替えます。

## 開発

```sh
pnpm install
pnpm build   # src/ → build/custom-blocks.js
pnpm start   # watch ビルド
```

### 新しいブロックの追加

1. `src/blocks/<block-name>/index.tsx` を作成（`registerBlockType` で登録、`category: "baizy-blocks"`）
2. `src/index.tsx` に `import './blocks/<block-name>';` を追加
3. `pnpm build`

## 構成

```
baizy-custom-blocks/
├── baizy-custom-blocks.php   プラグイン本体（エンキュー・カテゴリー登録）
├── build/
│   └── custom-blocks.js      ビルド出力（コミット対象）
├── src/
│   ├── index.tsx             エントリーポイント
│   └── blocks/               各ブロックのソース
├── vite.config.mts
├── tsconfig.json
└── package.json
```
